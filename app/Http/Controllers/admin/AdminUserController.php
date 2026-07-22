<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }
        if ($request->role_id) {
            $query->where('role_id', $request->role_id);
        }
        if ($request->status === 'suspended') {
            $query->where('is_suspended', true);
        } elseif ($request->status === 'active') {
            $query->where('is_active', true)->where('is_suspended', false);
        }

        $users = $query->latest()->paginate(20);
        $roles = Role::all();

        return view('backend.users.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
        $user->load(['orders' => function($q) { $q->latest()->take(10); }, 'wallet', 'verifications']);
        return view('backend.users.show', compact('user'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate(['role_id' => 'required|exists:roles,id']);

        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'You cannot change a Super Admin role.');
        }

        $user->update(['role_id' => $request->role_id]);
        return back()->with('success', 'User role updated successfully!');
    }

    public function suspend(User $user)
    {
        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'You cannot suspend a Super Admin.');
        }

        $user->update([
            'is_suspended' => true,
            'suspended_at' => now(),
        ]);

        return back()->with('success', 'User suspended successfully!');
    }

    public function unsuspend(User $user)
    {
        $user->update([
            'is_suspended' => false,
            'suspended_at' => null,
        ]);

        return back()->with('success', 'User unsuspended successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'You cannot delete a Super Admin.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    public function verifications()
    {
        $verifications = \App\Models\UserVerification::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(20);

        return view('backend.users.verifications', compact('verifications'));
    }

    public function updateVerification(Request $request, $id)
    {
        $verification = \App\Models\UserVerification::findOrFail($id);
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'rejection_reason' => 'required_if:status,rejected|nullable|string',
        ]);

        $verification->update([
            'status' => $request->status,
            'rejection_reason' => $request->status === 'rejected' ? $request->rejection_reason : null,
            'verified_at' => $request->status === 'verified' ? now() : null,
        ]);

        // Update user verification status
        $user = $verification->user;
        $field = match($verification->type) {
            'identity_card' => 'identity_verification',
            'payment_card' => 'payment_card_verification',
            'bank_account' => 'bank_account_verification',
            'delivery_address' => 'delivery_address_verification',
            default => null,
        };
        if ($field) {
            $user->update([$field => $request->status]);
        }

        return back()->with('success', 'Verification ' . $request->status . '!');
    }
}
