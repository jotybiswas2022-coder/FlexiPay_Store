<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('installment_plan_id')->nullable()->constrained('installment_plans')->nullOnDelete();
            $table->string('status')->default('pending'); // pending, processing, partial_paid, completed, cancelled
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('base_amount', 15, 2)->default(0);
            $table->decimal('shipping_fee', 15, 2)->default(0);
            $table->decimal('insurance_fee', 15, 2)->default(0);
            $table->decimal('interest_amount', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0);
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('remaining_amount', 15, 2)->default(0);
            $table->string('payment_type')->default('full'); // full, installment
            $table->boolean('has_insurance')->default(false);
            $table->string('delivery_status')->default('pending');
            $table->timestamp('delivered_at')->nullable();
            $table->unsignedBigInteger('delivery_address_id')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->decimal('cancellation_fee', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
