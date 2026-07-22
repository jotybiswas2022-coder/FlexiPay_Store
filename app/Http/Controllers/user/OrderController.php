<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\InstallmentPlan;
use App\Models\PlanChangeRequest;
use App\Models\PaymentTransaction;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = auth()->user()->orders()->with(['installmentPlan', 'items.product']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);
        return view('frontend.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $order->load([
            'items.product',
            'installmentPlan',
            'installmentPayments',
            'transactions',
            'deliveryAddress',
            'deliveryTrackings',
        ]);

        return view('frontend.order.show', compact('order'));
    }

    public function payInstallment(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $request->validate([
            'installment_payment_id' => 'required|exists:installment_payments,id',
        ]);

        $payment = $order->installmentPayments()->findOrFail($request->installment_payment_id);

        if ($payment->status === 'paid') {
            return back()->with('error', 'This installment is already paid.');
        }

        // Redirect to payment gateway with the installment details
        return redirect()->route('payment.installment', [$order->id, $payment->id]);
    }

    public function payPartial(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $request->validate([
            'amount' => 'required|numeric|min:100',
        ]);

        if ($request->amount > $order->remaining_amount) {
            return back()->with('error', 'Amount exceeds remaining balance.');
        }

        // Create transaction and redirect to payment
        $reference = 'PART-' . strtoupper(\Illuminate\Support\Str::random(12));
        PaymentTransaction::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'transaction_reference' => $reference,
            'gateway' => 'paystack',
            'amount' => $request->amount,
            'currency' => 'NGN',
            'status' => 'pending',
            'type' => 'payment',
        ]);

        return redirect()->route('payment.gateway', $order->id)
            ->with('info', 'Partial payment of ₦' . number_format($request->amount, 2) . ' initiated.');
    }

    public function payFull(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $reference = 'FULL-' . strtoupper(\Illuminate\Support\Str::random(12));
        PaymentTransaction::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'transaction_reference' => $reference,
            'gateway' => 'paystack',
            'amount' => $order->remaining_amount,
            'currency' => 'NGN',
            'status' => 'pending',
            'type' => 'payment',
        ]);

        return redirect()->route('payment.gateway', $order->id)
            ->with('info', 'Full payment of ₦' . number_format($order->remaining_amount, 2) . ' initiated.');
    }

    public function requestPlanChange(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $request->validate([
            'requested_plan_id' => 'required|exists:installment_plans,id',
            'reason' => 'required|string|min:10',
        ]);

        PlanChangeRequest::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'current_plan_id' => $order->installment_plan_id,
            'requested_plan_id' => $request->requested_plan_id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Plan change request submitted. Admin will review it.');
    }

    public function cancelOrder(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        if (!in_array($order->status, ['pending', 'processing', 'partial_paid'])) {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        $settings = \App\Models\Setting::first();
        $cancellationFeePercent = $settings->cancellation_fee_percentage ?? 10;
        $cancellationFee = ($order->grand_total * $cancellationFeePercent) / 100;

        $request->validate([
            'reason' => 'required|string|min:10',
            'accept_fee' => 'required|accepted',
        ]);

        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->reason,
            'cancellation_fee' => $cancellationFee,
        ]);

        return back()->with('info', 'Order cancelled. A ' . $cancellationFeePercent . '% cancellation fee (₦' . number_format($cancellationFee, 2) . ') applies.');
    }

    public function tracking(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $order->load(['deliveryTrackings' => function($q) {
            $q->latest('tracked_at');
        }]);

        return view('frontend.order.tracking', compact('order'));
    }
}
