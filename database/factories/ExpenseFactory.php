<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        return [
            'branch_id' => Branch::factory(),
            'source' => $this->faker->randomElement(['teacher_rent', 'other']),
            'category' => ucfirst($this->faker->word),
            'description' => $this->faker->sentence(8),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'receipt_image' => 'receipts/' . $this->faker->uuid . '.jpg',
            'remark' => $this->faker->boolean(30) ? $this->faker->sentence : null,
            'date' => $this->faker->date(),
            'entries' => [
                ['source' => ucfirst($this->faker->word)],
                ['source' => ucfirst($this->faker->word)],
            ],
        ];
    }
}
