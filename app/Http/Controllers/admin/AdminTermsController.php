<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsAndCondition;

class AdminTermsController extends Controller
{
    public function index()
    {
        $terms = TermsAndCondition::all();
        return view('backend.terms.index', compact('terms'));
    }

    public function update(Request $request, TermsAndCondition $term)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $term->update([
            'title' => $request->title,
            'content' => $request->content,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Terms updated successfully!');
    }
}
