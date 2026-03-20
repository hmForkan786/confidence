<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'designation' => $this->faker->randomElement(['Senior Teacher', 'Assistant Teacher', 'Lecturer']),
            'subject_id' => Subject::factory(),
            'mobile' => $this->faker->phoneNumber,
            'image' => $this->faker->boolean(30) ? 'teachers/' . $this->faker->uuid . '.jpg' : null,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
