<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use App\Models\UserVerification;
use App\Models\SavedCard;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user()->load(['orders' => function($q) {
            $q->latest()->take(5);
        }, 'wallet', 'deliveryAddresses', 'verifications', 'savedCards', 'bankAccounts']);

        return view('frontend.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('frontend.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['name', 'phone']);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:6|confirmed',
        ]);

        auth()->user()->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password updated successfully!');
    }

    // ===== Address Management =====
    public function addresses()
    {
        $addresses = auth()->user()->deliveryAddresses;
        return view('frontend.profile.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'label' => 'nullable|string|max:50',
            'is_default' => 'boolean',
        ]);

        $addressCount = auth()->user()->deliveryAddresses()->count();
        if ($addressCount >= 5) {
            return back()->with('error', 'You can only have up to 5 delivery addresses.');
        }

        if ($request->is_default) {
            auth()->user()->deliveryAddresses()->update(['is_default' => false]);
        }

        auth()->user()->deliveryAddresses()->create($request->all());

        return back()->with('success', 'Address added successfully!');
    }

    public function updateAddress(Request $request, DeliveryAddress $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        if ($request->is_default) {
            auth()->user()->deliveryAddresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        $address->update($request->all());
        return back()->with('success', 'Address updated!');
    }

    public function deleteAddress(DeliveryAddress $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }
        $address->delete();
        return back()->with('success', 'Address deleted!');
    }

    // ===== Cards Management =====
    public function cards()
    {
        $cards = auth()->user()->savedCards;
        return view('frontend.profile.cards', compact('cards'));
    }

    public function deleteCard(SavedCard $card)
    {
        if ($card->user_id !== auth()->id()) abort(403);
        $card->delete();
        return back()->with('success', 'Card removed!');
    }

    // ===== Bank Accounts =====
    public function banks()
    {
        $banks = auth()->user()->bankAccounts;
        return view('frontend.profile.banks', compact('banks'));
    }

    public function storeBank(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'account_name' => 'required|string|max:255',
            'bank_code' => 'nullable|string|max:10',
        ]);

        auth()->user()->bankAccounts()->create($request->all() + ['status' => 'pending']);
        return back()->with('success', 'Bank account added!');
    }

    public function deleteBank(BankAccount $bank)
    {
        if ($bank->user_id !== auth()->id()) abort(403);
        $bank->delete();
        return back()->with('success', 'Bank account removed!');
    }

    // ===== Verification =====
    public function verification()
    {
        $verifications = auth()->user()->verifications;
        return view('frontend.profile.verification', compact('verifications'));
    }

    public function submitVerification(Request $request)
    {
        $request->validate([
            'type' => 'required|in:identity_card,payment_card,bank_account,delivery_address',
            'document' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'document_number' => 'nullable|string|max:255',
        ]);

        $path = $request->file('document')->store('verifications', 'public');

        UserVerification::updateOrCreate(
            ['user_id' => auth()->id(), 'type' => $request->type],
            [
                'document_path' => $path,
                'document_number' => $request->document_number,
                'status' => 'pending',
            ]
        );

        return back()->with('success', 'Verification submitted for review!');
    }

    // ===== Account Deletion =====
    public function requestDeletion()
    {
        $user = auth()->user();

        if ($user->activeOrders()->count() > 0) {
            return back()->with('error', 'You have active orders. Please complete them before deleting your account.');
        }

        $user->update(['is_active' => false]);

        auth()->logout();

        return redirect('/')->with('info', 'Your account deletion request has been received.');
    }
}
