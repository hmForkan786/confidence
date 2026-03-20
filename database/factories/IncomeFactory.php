<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition(): array
    {
        return [
            'branch_id' => Branch::factory(),
            'source' => $this->faker->randomElement(['admission', 'form', 'penalty', 'book']),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'date' => $this->faker->date(),
            'entries' => [
                ['note' => $this->faker->sentence(3), 'amount' => $this->faker->randomFloat(2, 10, 500)],
            ],
        ];
    }
}
