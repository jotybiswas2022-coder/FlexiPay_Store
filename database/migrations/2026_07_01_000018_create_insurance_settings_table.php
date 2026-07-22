<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insurance_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Insurance Fee');
            $table->decimal('rate', 5, 2)->default(10);
            $table->string('type')->default('percentage');
            $table->boolean('is_enabled')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('insurance_settings')->insert([
            'name' => 'Insurance Fee',
            'rate' => 10,
            'type' => 'percentage',
            'is_enabled' => true,
            'description' => '10% insurance fee on total order amount',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('insurance_settings');
    }
};
