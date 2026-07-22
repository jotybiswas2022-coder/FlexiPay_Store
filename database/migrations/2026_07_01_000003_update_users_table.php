<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->default(3)->constrained('roles')->cascadeOnDelete();
            $table->string('phone')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('phone');
            $table->string('nid_number')->nullable()->after('avatar');
            $table->text('nid_image')->nullable()->after('nid_number');
            $table->string('identity_verification')->default('unverified')->after('nid_image');
            $table->string('payment_card_verification')->default('unverified');
            $table->string('bank_account_verification')->default('unverified');
            $table->string('delivery_address_verification')->default('unverified');
            $table->string('store_terms_acceptance')->default('unverified');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_suspended')->default(false);
            $table->timestamp('suspended_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'role_id', 'phone', 'avatar', 'nid_number', 'nid_image',
                'identity_verification', 'payment_card_verification',
                'bank_account_verification', 'delivery_address_verification',
                'store_terms_acceptance', 'is_active', 'is_suspended',
                'suspended_at', 'deleted_at'
            ]);
        });
    }
};
