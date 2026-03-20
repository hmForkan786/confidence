<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\ClassSession;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassSessionFactory extends Factory
{
    protected $model = ClassSession::class;

    public function definition(): array
    {
        return [
            'branch_id' => Branch::factory(),
            'teacher_id' => Teacher::factory(),
            'batch_id' => Batch::factory(),
            'time_slot_id' => TimeSlot::factory(),
            'subject_id' => Subject::factory(),
            'lecture_no' => $this->faker->numberBetween(1, 30),
            'class_date' => $this->faker->date(),
            'topic' => $this->faker->sentence(3),
            'remark' => $this->faker->boolean(40) ? $this->faker->sentence : null,
        ];
    }
}
