<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ExchangeRequest;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wishlist = auth()->user()->wishlist()->with('product.category')->latest()->get();
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function toggle(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $existing = auth()->user()->wishlist()->where('product_id', $request->product_id)->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['status' => 'removed', 'message' => 'Removed from wishlist']);
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);
            return response()->json(['status' => 'added', 'message' => 'Added to wishlist']);
        }
    }

    public function requestExchange(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'reason' => 'required|string|min:10',
        ]);

        $order = auth()->user()->orders()->findOrFail($request->order_id);

        ExchangeRequest::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'current_product_id' => $request->current_product_id ?? $order->items()->first()?->product_id,
            'requested_product_id' => $request->product_id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Exchange request submitted for admin review.');
    }

    public function remove($id)
    {
        auth()->user()->wishlist()->where('id', $id)->delete();
        return back()->with('success', 'Removed from wishlist');
    }
}
