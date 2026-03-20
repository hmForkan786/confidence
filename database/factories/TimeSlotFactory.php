<?php

namespace Database\Factories;

use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeSlotFactory extends Factory
{
    protected $model = TimeSlot::class;

    public function definition(): array
    {
        return [
            'time' => $this->faker->time('H:i:s'),
        ];
    }
}
