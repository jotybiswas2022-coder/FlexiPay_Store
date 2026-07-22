<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->decimal('expected_price', 15, 2)->nullable();
            $table->string('brand_preference')->nullable();
            $table->string('category_preference')->nullable();
            $table->string('status')->default('pending'); // pending, under_review, approved, rejected, added
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_requests');
    }
};
