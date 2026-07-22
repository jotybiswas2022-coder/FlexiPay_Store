<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            // Basic Info
            $table->string('title');

            // Foreign Key (better than integer)
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Contact Number (renamed for clarity)
            $table->string('contact_number', 20);

            // Location
            $table->string('division', 100);

            // File (image/video)
            $table->string('file')->nullable();

            // Status
            $table->boolean('status')->default(true);

            // Timestamps
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};