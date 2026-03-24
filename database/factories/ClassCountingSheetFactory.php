<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\ClassCountingSheet;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassCountingSheetFactory extends Factory
{
    protected $model = ClassCountingSheet::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'branch_id' => Branch::factory(),
            'teacher_id' => Teacher::factory(),
            'subject_id' => Subject::factory(),
            'batch_id' => Batch::factory(),
            'time_slot_id' => TimeSlot::factory(),
            'class_count' => $this->faker->numberBetween(1, 10),
            'topic' => $this->faker->sentence(3),
            'remark' => $this->faker->boolean(30) ? $this->faker->sentence : null,
        ];
    }
}
