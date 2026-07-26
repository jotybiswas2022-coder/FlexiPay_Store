<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('user_verifications')
            ->where('status', 'verified')
            ->update(['status' => 'approved']);

        DB::table('users')
            ->where('identity_verification', 'verified')
            ->update(['identity_verification' => 'approved']);

        DB::table('users')
            ->where('payment_card_verification', 'verified')
            ->update(['payment_card_verification' => 'approved']);

        DB::table('users')
            ->where('bank_account_verification', 'verified')
            ->update(['bank_account_verification' => 'approved']);

        DB::table('users')
            ->where('delivery_address_verification', 'verified')
            ->update(['delivery_address_verification' => 'approved']);
    }

    public function down(): void
    {
        DB::table('user_verifications')
            ->where('status', 'approved')
            ->update(['status' => 'verified']);

        DB::table('users')
            ->where('identity_verification', 'approved')
            ->update(['identity_verification' => 'verified']);

        DB::table('users')
            ->where('payment_card_verification', 'approved')
            ->update(['payment_card_verification' => 'verified']);

        DB::table('users')
            ->where('bank_account_verification', 'approved')
            ->update(['bank_account_verification' => 'verified']);

        DB::table('users')
            ->where('delivery_address_verification', 'approved')
            ->update(['delivery_address_verification' => 'verified']);
    }
};
