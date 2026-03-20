<?php

namespace Database\Factories;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    protected $model = Batch::class;

    public function definition(): array
    {
        return [
            'name' => 'Batch ' . strtoupper($this->faker->unique()->bothify('??-###')),
            'total_class' => $this->faker->numberBetween(10, 60),
            'duration' => $this->faker->numberBetween(1, 12) . ' months',
            'type' => $this->faker->randomElement([
                'offline_exam',
                'offline_regular',
                'online_regular',
                'online_exam',
                'offline_online',
            ]),
        ];
    }
}
