<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class AdminSupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withCount('products')->latest()->paginate(20);
        return view('backend.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('backend.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'api_endpoint' => 'nullable|url|max:255',
        ]);

        Supplier::create($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier added successfully!');
    }

    public function edit(Supplier $supplier)
    {
        return view('backend.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $supplier->update($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated!');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->products()->count() > 0) {
            return back()->with('error', 'Cannot delete supplier with existing products.');
        }
        $supplier->delete();
        return back()->with('success', 'Supplier deleted!');
    }
}
