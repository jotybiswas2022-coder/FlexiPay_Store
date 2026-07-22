<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('installment_payment_id')->nullable()->constrained('installment_payments')->nullOnDelete();
            $table->string('transaction_reference')->unique();
            $table->string('gateway'); // korapay, paystack, flutterwave
            $table->string('gateway_reference')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('fee', 15, 2)->default(0);
            $table->string('currency', 10)->default('NGN');
            $table->string('status')->default('pending'); // pending, success, failed, refunded
            $table->string('type')->default('payment'); // payment, refund, wallet_funding, wallet_transfer
            $table->text('gateway_response')->nullable();
            $table->text('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
