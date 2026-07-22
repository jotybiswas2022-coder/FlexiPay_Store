<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\PaymentTransaction;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wallet = auth()->user()->wallet;
        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => auth()->id(),
                'balance' => 0,
            ]);
        }

        $transactions = WalletTransaction::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('frontend.wallet.index', compact('wallet', 'transactions'));
    }

    public function fund(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100|max:10000000',
        ]);

        $reference = 'WAL-' . strtoupper(\Illuminate\Support\Str::random(12));

        // Create a pending wallet transaction
        PaymentTransaction::create([
            'user_id' => auth()->id(),
            'transaction_reference' => $reference,
            'gateway' => 'paystack', // default
            'amount' => $request->amount,
            'currency' => 'NGN',
            'status' => 'pending',
            'type' => 'wallet_funding',
        ]);

        // Redirect to payment gateway page
        return redirect()->route('wallet.fund.gateway', $reference);
    }

    public function fundGateway($reference)
    {
        $transaction = PaymentTransaction::where('transaction_reference', $reference)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('frontend.wallet.fund', compact('transaction'));
    }

    public function history()
    {
        $transactions = WalletTransaction::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('frontend.wallet.history', compact('transactions'));
    }
}
