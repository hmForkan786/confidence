<?php

namespace Database\Factories;

use App\Models\Banking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankingFactory extends Factory
{
    protected $model = Banking::class;

    public function definition(): array
    {
        return [
            'bank_title' => $this->faker->randomElement(['Savings', 'Current', 'Payroll']),
            'bank_name' => $this->faker->company . ' Bank',
            'account_no' => strtoupper($this->faker->bothify('AC-####-####')),
            'remark' => $this->faker->boolean(30) ? $this->faker->sentence : null,
        ];
    }
}
