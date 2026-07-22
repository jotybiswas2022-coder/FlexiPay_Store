<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Faq;
use App\Models\TermsAndCondition;

class SiteController extends Controller
{
    // Homepage
    public function index()
    {
        $settings = Setting::first();
        $slider = Slider::latest()->first();
        $featuredProducts = Product::where('featured', true)
            ->where('status', 'active')
            ->with(['category', 'primaryImage', 'installmentPlans'])
            ->latest()
            ->take(12)
            ->get()
            ->each(function ($product) {
                $product->installment_plans_count = $product->installmentPlans->count();
                return $product;
            });
        $categories = Category::all();
        $brands = Brand::where('is_active', true)->get();
        $newArrivals = Product::where('status', 'active')
            ->with(['category', 'primaryImage'])
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.index', compact(
            'settings', 'slider', 'featuredProducts',
            'categories', 'brands', 'newArrivals'
        ));
    }

    // Shop page
    public function shop(Request $request)
    {
        $query = Product::where('status', 'active')->with(['category', 'brand', 'primaryImage']);

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort
        switch ($request->sort) {
            case 'price_asc': $query->orderBy('price', 'asc'); break;
            case 'price_desc': $query->orderBy('price', 'desc'); break;
            case 'newest': $query->latest(); break;
            case 'oldest': $query->oldest(); break;
            case 'name': $query->orderBy('name', 'asc'); break;
            default: $query->latest(); break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $brands = Brand::where('is_active', true)->get();

        return view('frontend.shop', compact('products', 'categories', 'brands'));
    }

    // Single Product page
    public function product($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->with(['category', 'brand', 'images', 'installmentPlans', 'reviews.user'])
            ->firstOrFail();

        // Check if in wishlist
        $inWishlist = auth()->check() && auth()->user()->wishlist()
            ->where('product_id', $product->id)->exists();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->with(['primaryImage'])
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts', 'inWishlist'));
    }

    // Checkout page
    public function checkout()
    {
        return view('frontend.checkout');
    }

    // FAQ page
    public function faq()
    {
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get()->groupBy('category');
        return view('frontend.faq', compact('faqs'));
    }

    // Terms & Conditions
    public function terms($type = 'general')
    {
        $terms = TermsAndCondition::where('type', $type)->where('is_active', true)->first();
        return view('frontend.terms', compact('terms', 'type'));
    }

    // Contact page
    public function contact()
    {
        return view('frontend.contact');
    }

    // About page
    public function about()
    {
        return view('frontend.about');
    }
}
