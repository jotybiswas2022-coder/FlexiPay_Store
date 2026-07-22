<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_fees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('type')->default('fixed'); // fixed, percentage
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed default fees
        DB::table('product_fees')->insert([
            ['name' => 'Delivery Fee', 'slug' => 'delivery_fee', 'amount' => 5000, 'type' => 'fixed', 'description' => 'Standard delivery fee', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Insurance Fee', 'slug' => 'insurance_fee', 'amount' => 10, 'type' => 'percentage', 'description' => '10% insurance on total order', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Default Charge', 'slug' => 'default_charge', 'amount' => 2000, 'type' => 'fixed', 'description' => 'Default processing charge', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retrieval Fee', 'slug' => 'retrieval_fee', 'amount' => 3000, 'type' => 'fixed', 'description' => 'Product retrieval fee for cancellations', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cancellation Fee', 'slug' => 'cancellation_fee', 'amount' => 10, 'type' => 'percentage', 'description' => '10% cancellation charge', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('product_fees');
    }
};
