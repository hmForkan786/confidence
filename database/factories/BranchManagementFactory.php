<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\BranchManagement;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchManagementFactory extends Factory
{
    protected $model = BranchManagement::class;

    public function definition(): array
    {
        return [
            'branch_id' => Branch::factory(),
            'date' => $this->faker->date(),
            'today_admission' => $this->faker->numberBetween(0, 50),
            'opening_balance' => $this->faker->randomFloat(2, 0, 50000),
            'today_total_income' => $this->faker->randomFloat(2, 0, 50000),
            'bank_deposit' => $this->faker->randomFloat(2, 0, 20000),
            'total_expense' => $this->faker->randomFloat(2, 0, 20000),
            'penalty_collected' => $this->faker->randomFloat(2, 0, 5000),
            'cash_in_hand' => $this->faker->randomFloat(2, 0, 30000),
            'foundation_count' => $this->faker->numberBetween(0, 30),
            'preli_count' => $this->faker->numberBetween(0, 30),
            'preli_online_count' => $this->faker->numberBetween(0, 30),
            'exam_count' => $this->faker->numberBetween(0, 30),
        ];
    }
}
