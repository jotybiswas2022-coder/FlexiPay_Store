<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\InstallmentPlan;
use App\Models\InstallmentPayment;
use App\Models\PaymentTransaction;
use App\Models\Wallet;
use App\Models\DeliveryAddress;
use App\Models\Setting;
use App\Models\InsuranceSetting;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        $installmentPlans = InstallmentPlan::where('is_active', true)->orderBy('sort_order')->get();
        $addresses = auth()->user()->deliveryAddresses;
        $settings = Setting::first();
        $insurance = InsuranceSetting::first();
        $wallet = auth()->user()->wallet;

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('frontend.checkout', compact(
            'cart', 'total', 'installmentPlans',
            'addresses', 'settings', 'insurance', 'wallet'
        ));
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_type' => 'required|in:full,installment',
            'installment_plan_id' => 'required_if:payment_type,installment|nullable|exists:installment_plans,id',
            'delivery_address_id' => 'required|exists:delivery_addresses,id',
            'has_insurance' => 'boolean',
            'payment_method' => 'required|in:pay_now,wallet,gateway',
            'agree_terms' => 'required|accepted',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $baseAmount = $totalAmount;
        $interestAmount = 0;
        $shippingFee = \App\Models\ProductFee::where('slug', 'delivery_fee')->first()?->amount ?? 0;
        $insuranceFee = 0;
        $insurance = InsuranceSetting::first();

        if ($request->has_insurance && $insurance?->is_enabled) {
            $insuranceFee = ($totalAmount * $insurance->rate) / 100;
        }

        $installmentPlan = null;
        if ($request->payment_type === 'installment') {
            $installmentPlan = InstallmentPlan::findOrFail($request->installment_plan_id);
            $interestAmount = ($totalAmount * $installmentPlan->interest_rate) / 100;
        }

        $grandTotal = $baseAmount + $shippingFee + $insuranceFee + $interestAmount;

        // Create order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'user_id' => auth()->id(),
            'installment_plan_id' => $installmentPlan?->id,
            'status' => $request->payment_type === 'installment' ? 'pending' : 'processing',
            'total_amount' => $totalAmount,
            'base_amount' => $baseAmount,
            'shipping_fee' => $shippingFee,
            'insurance_fee' => $insuranceFee,
            'interest_amount' => $interestAmount,
            'grand_total' => $grandTotal,
            'paid_amount' => 0,
            'remaining_amount' => $grandTotal,
            'payment_type' => $request->payment_type,
            'has_insurance' => $request->has_insurance ?? false,
            'delivery_address_id' => $request->delivery_address_id,
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'unit_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Create installment payment schedule if installment
        if ($request->payment_type === 'installment' && $installmentPlan) {
            $perInstallment = $grandTotal / $installmentPlan->duration;
            $dueDate = now();
            for ($i = 1; $i <= $installmentPlan->duration; $i++) {
                $dueDate = $dueDate->addDays($installmentPlan->type === 'weekly' ? 7 : 30);
                InstallmentPayment::create([
                    'order_id' => $order->id,
                    'installment_number' => $i,
                    'amount' => $perInstallment,
                    'due_date' => $dueDate,
                    'status' => $i === 1 ? 'pending' : 'pending',
                ]);
            }
        }

        // Clear cart
        session()->forget('cart');

        // Process payment
        if ($request->payment_method === 'wallet') {
            // Redirect to wallet payment
            return $this->processWalletPayment($order);
        }

        // Redirect to payment gateway
        return redirect()->route('payment.gateway', $order->id);
    }

    private function processWalletPayment(Order $order)
    {
        $wallet = auth()->user()->wallet;
        if (!$wallet || $wallet->balance < $order->grand_total) {
            return redirect()->route('payment.gateway', $order->id)
                ->with('error', 'Insufficient wallet balance.');
        }

        $balanceBefore = $wallet->balance;
        $wallet->decrement('balance', $order->grand_total);

        \App\Models\WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'user_id' => auth()->id(),
            'amount' => $order->grand_total,
            'balance_before' => $balanceBefore,
            'balance_after' => $wallet->balance,
            'type' => 'payment',
            'description' => 'Payment for order #' . $order->order_number,
            'status' => 'completed',
        ]);

        $order->update([
            'paid_amount' => $order->grand_total,
            'remaining_amount' => 0,
            'status' => 'processing',
        ]);

        // Mark first installment as paid
        $firstInstallment = $order->installmentPayments()->first();
        if ($firstInstallment) {
            $firstInstallment->update([
                'status' => 'paid',
                'paid_date' => now(),
                'paid_amount' => $order->grand_total,
            ]);
        }

        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Payment successful via Wallet!');
    }

    public function paymentGateway(Order $order)
    {
        return view('frontend.payment.gateway', compact('order'));
    }

    public function processPayment(Request $request, Order $order)
    {
        $request->validate([
            'gateway' => 'required|in:paystack,flutterwave,korapay',
        ]);

        $transaction = PaymentTransaction::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'amount' => $order->remaining_amount ?? $order->grand_total,
            'transaction_reference' => 'TXN-' . strtoupper(Str::random(15)),
            'gateway' => $request->gateway,
            'status' => 'pending',
        ]);

        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function confirmation(Order $order)
    {
        $order->load(['items.product', 'installmentPlan', 'installmentPayments', 'deliveryAddress']);
        return view('frontend.order.confirmation', compact('order'));
    }
}
