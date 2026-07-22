<?php
use App\Models\Setting;
use App\Models\ProductFee;

function currency()
{
    $settings = Setting::first();
    return $settings?->currency_symbol ?? '₦';
}

function formatPrice($amount)
{
    return currency() . number_format($amount, 2);
}

function storeName()
{
    $settings = Setting::first();
    return $settings?->store_name ?? 'KistiBuy';
}

function cartCount()
{
    $cart = session()->get('cart', []);
    return count($cart);
}

function getFee($slug)
{
    $fee = ProductFee::where('slug', $slug)->first();
    if (!$fee) return 0;
    return $fee->type === 'percentage' ? $fee->amount : $fee->amount;
}

function getDeliveryThreshold()
{
    $settings = Setting::first();
    return $settings?->delivery_threshold_percentage ?? 70;
}

function getDiscountPercentage($order = null)
{
    return 0;
}

function orderStatusBadge($status)
{
    $colors = [
        'pending' => 'warning',
        'processing' => 'info',
        'partial_paid' => 'primary',
        'completed' => 'success',
        'cancelled' => 'danger',
    ];
    $color = $colors[$status] ?? 'secondary';
    return "<span class=\"badge bg-{$color}\">{$status}</span>";
}

function deliveryStatusBadge($status)
{
    $colors = [
        'pending' => 'secondary',
        'processing' => 'info',
        'shipped' => 'primary',
        'in_transit' => 'warning',
        'out_for_delivery' => 'info',
        'delivered' => 'success',
        'failed' => 'danger',
    ];
    $color = $colors[$status] ?? 'secondary';
    return "<span class=\"badge bg-{$color}\">{$status}</span>";
}

function verificationBadge($status)
{
    $colors = [
        'verified' => 'success',
        'pending' => 'warning',
        'rejected' => 'danger',
        'unverified' => 'secondary',
    ];
    $color = $colors[$status] ?? 'secondary';
    return "<span class=\"badge bg-{$color}\">{$status}</span>";
}

// Calculate installment breakdown
function calculateInstallmentBreakdown($totalAmount, $installmentPlan)
{
    $interestAmount = ($totalAmount * $installmentPlan->interest_rate) / 100;
    $totalWithInterest = $totalAmount + $interestAmount;
    $perInstallment = $totalWithInterest / $installmentPlan->duration;

    return [
        'total' => $totalWithInterest,
        'interest' => $interestAmount,
        'per_installment' => $perInstallment,
        'duration' => $installmentPlan->duration,
        'type' => $installmentPlan->type,
    ];
}
