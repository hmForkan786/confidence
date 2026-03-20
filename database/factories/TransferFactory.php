<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Transfer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferFactory extends Factory
{
    protected $model = Transfer::class;

    public function definition(): array
    {
        return [
            'from_branch_id' => Branch::factory(),
            'to_branch_id' => Branch::factory(),
            'from_batch_id' => Batch::factory(),
            'to_batch_id' => Batch::factory(),
            'from_branch_roll' => $this->faker->bothify('BR-###'),
            'from_branch_mr_no' => $this->faker->bothify('MR-####'),
            'from_branch_amount' => $this->faker->randomFloat(2, 100, 5000),
            'to_branch_roll' => $this->faker->bothify('BR-###'),
            'to_branch_mr_no' => $this->faker->bothify('MR-####'),
            'to_branch_amount' => $this->faker->randomFloat(2, 100, 5000),
            'branch_remark' => $this->faker->boolean(30) ? $this->faker->sentence : null,
            'from_batch_old_roll' => $this->faker->bothify('BR-###'),
            'from_batch_old_mr_no' => $this->faker->bothify('MR-####'),
            'from_batch_old_amount' => $this->faker->randomFloat(2, 100, 5000),
            'to_batch_new_roll' => $this->faker->bothify('BR-###'),
            'to_batch_new_mr_no' => $this->faker->bothify('MR-####'),
            'to_batch_new_amount' => $this->faker->randomFloat(2, 100, 5000),
            'batch_remark' => $this->faker->boolean(30) ? $this->faker->sentence : null,
            'old_roll' => $this->faker->bothify('OLD-###'),
            'new_roll' => $this->faker->bothify('NEW-###'),
            'old_mr_no' => $this->faker->bothify('MR-####'),
            'new_mr_no' => $this->faker->bothify('MR-####'),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'remark' => $this->faker->boolean(30) ? $this->faker->sentence : null,
        ];
    }
}
