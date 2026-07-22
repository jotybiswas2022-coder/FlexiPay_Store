<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanChangeRequest;
use App\Models\ProductRequest;
use App\Models\ExchangeRequest;
use App\Models\InstallmentPlan;

class AdminRequestController extends Controller
{
    public function planChanges()
    {
        $requests = PlanChangeRequest::with(['user', 'order', 'currentPlan', 'requestedPlan'])
            ->latest()
            ->paginate(20);
        return view('backend.requests.plan-changes', compact('requests'));
    }

    public function approvePlanChange(PlanChangeRequest $planChangeRequest)
    {
        $planChangeRequest->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        // Update the order's installment plan
        $order = $planChangeRequest->order;
        $order->update([
            'installment_plan_id' => $planChangeRequest->requested_plan_id,
        ]);

        // Recalculate installment payments
        $order->installmentPayments()->delete();
        $newPlan = $planChangeRequest->requestedPlan;
        $perInstallment = $order->remaining_amount / $newPlan->duration;
        $dueDate = now();

        for ($i = 1; $i <= $newPlan->duration; $i++) {
            $dueDate = $dueDate->addDays($newPlan->type === 'weekly' ? 7 : 30);
            \App\Models\InstallmentPayment::create([
                'order_id' => $order->id,
                'installment_number' => $i,
                'amount' => $perInstallment,
                'due_date' => $dueDate,
                'status' => 'pending',
            ]);
        }

        return back()->with('success', 'Plan change approved successfully!');
    }

    public function rejectPlanChange(PlanChangeRequest $planChangeRequest, Request $request)
    {
        $request->validate(['admin_notes' => 'nullable|string']);

        $planChangeRequest->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'rejected_at' => now(),
        ]);

        return back()->with('success', 'Plan change rejected.');
    }

    public function productRequests()
    {
        $requests = ProductRequest::with('user')->latest()->paginate(20);
        return view('backend.requests.product-requests', compact('requests'));
    }

    public function updateProductRequest(Request $request, ProductRequest $productRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $productRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'approved_at' => $request->status === 'approved' ? now() : null,
        ]);

        return back()->with('success', 'Product request ' . $request->status . '!');
    }

    public function exchangeRequests()
    {
        $requests = ExchangeRequest::with(['user', 'order', 'currentProduct', 'requestedProduct'])
            ->latest()
            ->paginate(20);
        return view('backend.requests.exchange-requests', compact('requests'));
    }

    public function updateExchangeRequest(Request $request, ExchangeRequest $exchangeRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,completed',
            'admin_notes' => 'nullable|string',
        ]);

        $exchangeRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Exchange request ' . $request->status . '!');
    }
}
