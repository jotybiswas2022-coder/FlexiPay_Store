<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        // সব workers দেখাও — user_id আছে বা নেই উভয়ই
        $posts      = Post::with('user')->latest()->get();
        $categories = Category::all();

        return view('backend.posts.index', compact('posts', 'categories'));
    }

    // ================= CREATE =================
    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', compact('categories'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'contact_number'  => 'required|string|max:20',
            'division'        => 'required|string|max:100',
            'status'          => 'nullable|in:0,1',
            'file'            => 'required|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,video/mp4|max:512000',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mime = $file->getMimeType();

            if (!in_array($mime, ['video/mp4', 'image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                return back()->with('error', 'Only Image and MP4 video allowed!');
            }

            $filePath = $file->store('posts', 'public');
        }

        Post::create([
            'title'          => $request->title,
            'category_id'    => $request->category_id,
            'contact_number' => $request->contact_number,
            'division'       => $request->division,
            'status'         => (int) ($request->status ?? 0),
            'file'           => $filePath,
        ]);

        return redirect('/admin/workers')->with('success', 'Worker added successfully!');
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'contact_number' => 'required|string|max:20',
            'division'       => 'required|string|max:100',
            'status'         => 'nullable|in:0,1',
            'file'           => 'nullable|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,video/mp4|max:512000',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mime = $file->getMimeType();

            if (!in_array($mime, ['video/mp4', 'image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                return response()->json(['status' => false, 'message' => 'Invalid file type']);
            }

            if ($post->file && Storage::disk('public')->exists($post->file)) {
                Storage::disk('public')->delete($post->file);
            }

            $post->file = $file->store('posts', 'public');
        }

        $post->update([
            'title'          => $request->title,
            'category_id'    => $request->category_id,
            'contact_number' => $request->contact_number,
            'division'       => $request->division,
            'status'         => (int) ($request->status ?? 0),
        ]);

        return redirect('/admin/workers')->with('success', 'Worker updated successfully!');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->file && Storage::disk('public')->exists($post->file)) {
            Storage::disk('public')->delete($post->file);
        }

        $post->delete();

        return redirect('/admin/workers')->with('success', 'Worker deleted successfully!');
    }

    // ================= VIEW FILE =================
    public function viewFile($id)
    {
        $post = Post::findOrFail($id);

        if (!$post->file) {
            abort(404);
        }

        $filePath = storage_path('app/public/' . $post->file);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->file($filePath);
    }
}
