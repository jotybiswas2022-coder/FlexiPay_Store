<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('label')->nullable();
            $table->string('recipient_name');
            $table->string('phone');
            $table->text('address_line1');
            $table->text('address_line2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country')->default('Nigeria');
            $table->string('postal_code')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            // Limit to 5 addresses per user
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_addresses');
    }
};
