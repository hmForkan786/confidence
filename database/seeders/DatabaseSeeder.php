<?php

namespace Database\Seeders;

use App\Models\Banking;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\BranchManagement;
use App\Models\ClassCountingSheet;
use App\Models\ClassSession;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TimeSlot;
use App\Models\Transfer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $branches = Branch::factory()->count(5)->create();
        $subjects = Subject::factory()->count(5)->create();
        $teachers = Teacher::factory()
            ->count(5)
            ->state(fn () => ['subject_id' => $subjects->random()->id])
            ->create();
        $batches = Batch::factory()->count(5)->create();
        $timeSlots = TimeSlot::factory()->count(5)->create();

        ClassSession::factory()
            ->count(5)
            ->state(fn () => [
                'branch_id' => $branches->random()->id,
                'teacher_id' => $teachers->random()->id,
                'batch_id' => $batches->random()->id,
                'time_slot_id' => $timeSlots->random()->id,
                'subject_id' => $subjects->random()->id,
            ])
            ->create();

        ClassCountingSheet::factory()
            ->count(5)
            ->state(fn () => [
                'teacher_id' => $teachers->random()->id,
                'subject_id' => $subjects->random()->id,
                'batch_id' => $batches->random()->id,
                'time_slot_id' => $timeSlots->random()->id,
            ])
            ->create();

        Income::factory()
            ->count(5)
            ->state(fn () => ['branch_id' => $branches->random()->id])
            ->create();

        Expense::factory()
            ->count(5)
            ->state(fn () => ['branch_id' => $branches->random()->id])
            ->create();

        Banking::factory()->count(5)->create();

        BranchManagement::factory()
            ->count(5)
            ->state(fn () => ['branch_id' => $branches->random()->id])
            ->create();

        Transfer::factory()
            ->count(5)
            ->state(fn () => [
                'from_branch_id' => $branches->random()->id,
                'to_branch_id' => $branches->random()->id,
                'from_batch_id' => $batches->random()->id,
                'to_batch_id' => $batches->random()->id,
            ])
            ->create();
    }
}
