<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('installment_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->integer('installment_number');
            $table->decimal('amount', 15, 2)->default(0);
            $table->date('due_date');
            $table->date('paid_date')->nullable();
            $table->string('status')->default('pending'); // pending, paid, overdue, partial
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'installment_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('installment_payments');
    }
};
