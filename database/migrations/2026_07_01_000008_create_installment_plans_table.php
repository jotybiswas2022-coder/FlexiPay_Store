<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('installment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // weekly, monthly
            $table->integer('duration'); // number of installments
            $table->integer('duration_days'); // total days
            $table->decimal('interest_rate', 5, 2)->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed default installment plans
        $plans = [];
        // Weekly plans: 4 to 40 weeks
        for ($i = 4; $i <= 40; $i += 4) {
            $plans[] = [
                'name' => $i . ' Weeks',
                'type' => 'weekly',
                'duration' => $i,
                'duration_days' => $i * 7,
                'interest_rate' => $i <= 12 ? 5 : ($i <= 24 ? 10 : 15),
                'is_active' => true,
                'sort_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // Monthly plans: 1 to 12 months
        for ($i = 1; $i <= 12; $i++) {
            $plans[] = [
                'name' => $i . ' Month' . ($i > 1 ? 's' : ''),
                'type' => 'monthly',
                'duration' => $i,
                'duration_days' => $i * 30,
                'interest_rate' => $i <= 3 ? 8 : ($i <= 6 ? 12 : ($i <= 9 ? 18 : 22)),
                'is_active' => true,
                'sort_order' => 100 + $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('installment_plans')->insert($plans);
    }

    public function down(): void
    {
        Schema::dropIfExists('installment_plans');
    }
};
