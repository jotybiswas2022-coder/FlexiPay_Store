<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::latest()->paginate(20);
        return view('backend.promo-codes.index', compact('promoCodes'));
    }

    public function create()
    {
        return view('backend.promo-codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0.01',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'boolean',
        ]);

        PromoCode::create($request->all());
        return redirect()->route('admin.promo-codes.index')->with('success', 'Promo code created!');
    }

    public function edit(PromoCode $promoCode)
    {
        return view('backend.promo-codes.edit', compact('promoCode'));
    }

    public function update(Request $request, PromoCode $promoCode)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes,code,' . $promoCode->id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0.01',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'boolean',
        ]);

        $promoCode->update($request->all());
        return redirect()->route('admin.promo-codes.index')->with('success', 'Promo code updated!');
    }

    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        return back()->with('success', 'Promo code deleted!');
    }
}
