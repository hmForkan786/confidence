<?php

namespace Database\Seeders;

use App\Models\Banking;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\ClassCountingSheet;
use App\Models\DailyReporting;
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
        $branches = collect([
            ['name' => 'Farmgate', 'code' => 'BR-001', 'address' => 'Farmgate, Dhaka', 'phone' => '01700000001', 'status' => 'active'],
            ['name' => 'Mirpur', 'code' => 'BR-002', 'address' => 'Mirpur, Dhaka', 'phone' => '01700000002', 'status' => 'active'],
            ['name' => 'Malibagh', 'code' => 'BR-003', 'address' => 'Malibagh, Dhaka', 'phone' => '01700000003', 'status' => 'active'],
            ['name' => 'Chattagram', 'code' => 'BR-004', 'address' => 'Chattogram', 'phone' => '01700000004', 'status' => 'active'],
            ['name' => 'Sylhet', 'code' => 'BR-005', 'address' => 'Sylhet', 'phone' => '01700000005', 'status' => 'active'],
            ['name' => 'Khulna', 'code' => 'BR-006', 'address' => 'Khulna', 'phone' => '01700000006', 'status' => 'active'],
            ['name' => 'Barisal', 'code' => 'BR-007', 'address' => 'Barisal', 'phone' => '01700000007', 'status' => 'active'],
        ])->map(fn ($data) => Branch::firstOrCreate(['code' => $data['code']], $data));

        $subjects = collect([
            'Bangla',
            'English',
            'Math',
            'Science',
            'Bangladesh Affairs',
            'International Affairs',
            'Mental Ability',
        ])->map(fn ($name) => Subject::firstOrCreate(['name' => $name]));

        $branchByName = $branches->keyBy('name');
        $subjectByName = $subjects->keyBy('name');

        $teachers = collect([
            ['name' => 'Robiul Awal Sir', 'designation' => 'Senior Teacher', 'subject' => 'English'],
            ['name' => 'Rana Sir', 'designation' => 'Senior Teacher', 'subject' => 'Bangla'],
            ['name' => 'Pavel Sir', 'designation' => 'Senior Teacher', 'subject' => 'Science'],
            ['name' => 'Atik Sir', 'designation' => 'Senior Teacher', 'subject' => 'International Affairs'],
            ['name' => 'Aurin Sir', 'designation' => 'Senior Teacher', 'subject' => 'Math'],
            ['name' => 'Jibon Sir', 'designation' => 'Senior Teacher', 'subject' => 'Bangladesh Affairs'],
            ['name' => 'Sanowar Sir', 'designation' => 'Senior Teacher', 'subject' => 'Mental Ability'],
        ])->map(function ($data) use ($subjectByName) {
            return Teacher::firstOrCreate(
                ['name' => $data['name']],
                [
                    'designation' => $data['designation'],
                    'subject_id' => $subjectByName[$data['subject']]->id,
                    'mobile' => '01700000000',
                    'image' => null,
                    'status' => 'active',
                ]
            );
        });

        $batches = collect([
            ['name' => '47th Written', 'total_class' => 120, 'status' => 'active', 'type' => 'offline_regular'],
            ['name' => '50th Viva', 'total_class' => 80, 'status' => 'active', 'type' => 'offline_exam'],
            ['name' => '51st Foundation', 'total_class' => 150, 'status' => 'active', 'type' => 'offline_regular'],
            ['name' => '52nd Foundation', 'total_class' => 150, 'status' => 'active', 'type' => 'offline_regular'],
            ['name' => '51st Peli', 'total_class' => 60, 'status' => 'active', 'type' => 'offline_online'],
        ])->map(fn ($data) => Batch::firstOrCreate(['name' => $data['name']], $data));

        $timeSlots = collect([
            '10:00:00',
            '12:00:00',
            '15:00:00',
            '17:00:00',
            '19:00:00',
        ])->map(fn ($time) => TimeSlot::firstOrCreate(['time' => $time]));
        $timeSlotByTime = $timeSlots->keyBy('time');

        collect([
            'Teacher Payment',
            'Utility',
            'Entertainment',
            'Office Rent',
        ])->each(fn ($name) => Expense::firstOrCreate(['name' => $name]));

        collect([
            'Admission',
            'Book',
            'Penalty',
            'Form Fee',
        ])->each(fn ($name) => Income::firstOrCreate(['name' => $name]));

        $classSheets = collect([
            [
                'date' => now()->toDateString(),
                'branch' => 'Farmgate',
                'teacher' => 'Robiul Awal Sir',
                'subject' => 'English',
                'batch' => '47th Written',
                'time' => '10:00:00',
                'class_count' => 1,
                'topic' => 'Parts of speech',
                'remark' => 'Good attendance',
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Mirpur',
                'teacher' => 'Rana Sir',
                'subject' => 'Bangla',
                'batch' => '51st Foundation',
                'time' => '12:00:00',
                'class_count' => 1,
                'topic' => 'Bangla grammar basics',
                'remark' => null,
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Malibagh',
                'teacher' => 'Pavel Sir',
                'subject' => 'Science',
                'batch' => '52nd Foundation',
                'time' => '15:00:00',
                'class_count' => 1,
                'topic' => 'Human digestion',
                'remark' => null,
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Chattagram',
                'teacher' => 'Atik Sir',
                'subject' => 'International Affairs',
                'batch' => '50th Viva',
                'time' => '17:00:00',
                'class_count' => 1,
                'topic' => 'UN and global bodies',
                'remark' => 'Q&A session',
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Sylhet',
                'teacher' => 'Aurin Sir',
                'subject' => 'Math',
                'batch' => '51st Peli',
                'time' => '19:00:00',
                'class_count' => 1,
                'topic' => 'Basic algebra',
                'remark' => null,
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Khulna',
                'teacher' => 'Jibon Sir',
                'subject' => 'Bangladesh Affairs',
                'batch' => '47th Written',
                'time' => '10:00:00',
                'class_count' => 1,
                'topic' => 'Liberation war timeline',
                'remark' => null,
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Barisal',
                'teacher' => 'Sanowar Sir',
                'subject' => 'Mental Ability',
                'batch' => '51st Foundation',
                'time' => '12:00:00',
                'class_count' => 1,
                'topic' => 'Series and pattern',
                'remark' => 'Practice test',
            ],
        ]);

        $teacherByName = $teachers->keyBy('name');
        $batchByName = $batches->keyBy('name');

        $classSheets->each(function ($data) use ($branchByName, $teacherByName, $subjectByName, $batchByName, $timeSlotByTime) {
            ClassCountingSheet::firstOrCreate(
                [
                    'date' => $data['date'],
                    'branch_id' => $branchByName[$data['branch']]->id,
                    'teacher_id' => $teacherByName[$data['teacher']]->id,
                    'subject_id' => $subjectByName[$data['subject']]->id,
                    'batch_id' => $batchByName[$data['batch']]->id,
                    'time_slot_id' => $timeSlotByTime[$data['time']]->id,
                ],
                [
                    'class_count' => $data['class_count'],
                    'topic' => $data['topic'],
                    'remark' => $data['remark'],
                ]
            );
        });

        $dailyReportings = collect([
            [
                'date' => now()->toDateString(),
                'branch' => 'Farmgate',
                'batch' => '47th Written',
                'admission' => 12,
                'opening_balance' => 5000,
                'income_items' => [
                    ['name' => 'Admission', 'amount' => 12000],
                    ['name' => 'Book', 'amount' => 3000],
                ],
                'expense_items' => [
                    ['name' => 'Teacher Payment', 'amount' => 7000],
                    ['name' => 'Utility', 'amount' => 1200],
                ],
                'bank_deposit_amount' => 5000,
                'cash_in_hand' => 7800,
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Mirpur',
                'batch' => '51st Foundation',
                'admission' => 9,
                'opening_balance' => 3500,
                'income_items' => [
                    ['name' => 'Admission', 'amount' => 9000],
                    ['name' => 'Form Fee', 'amount' => 800],
                ],
                'expense_items' => [
                    ['name' => 'Office Rent', 'amount' => 4000],
                    ['name' => 'Utility', 'amount' => 900],
                ],
                'bank_deposit_amount' => 3000,
                'cash_in_hand' => 5400,
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Malibagh',
                'batch' => '52nd Foundation',
                'admission' => 7,
                'opening_balance' => 2800,
                'income_items' => [
                    ['name' => 'Admission', 'amount' => 7000],
                    ['name' => 'Penalty', 'amount' => 200],
                ],
                'expense_items' => [
                    ['name' => 'Teacher Payment', 'amount' => 4500],
                    ['name' => 'Entertainment', 'amount' => 500],
                ],
                'bank_deposit_amount' => 2000,
                'cash_in_hand' => 5000,
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Chattagram',
                'batch' => '50th Viva',
                'admission' => 5,
                'opening_balance' => 2200,
                'income_items' => [
                    ['name' => 'Admission', 'amount' => 6000],
                    ['name' => 'Book', 'amount' => 1500],
                ],
                'expense_items' => [
                    ['name' => 'Teacher Payment', 'amount' => 3800],
                    ['name' => 'Office Rent', 'amount' => 2000],
                ],
                'bank_deposit_amount' => 2500,
                'cash_in_hand' => 3400,
            ],
            [
                'date' => now()->toDateString(),
                'branch' => 'Sylhet',
                'batch' => '51st Peli',
                'admission' => 4,
                'opening_balance' => 1800,
                'income_items' => [
                    ['name' => 'Admission', 'amount' => 4000],
                    ['name' => 'Form Fee', 'amount' => 500],
                ],
                'expense_items' => [
                    ['name' => 'Utility', 'amount' => 600],
                    ['name' => 'Entertainment', 'amount' => 400],
                ],
                'bank_deposit_amount' => 1500,
                'cash_in_hand' => 3800,
            ],
        ]);

        $dailyReportings->each(function ($data) use ($branchByName, $batchByName) {
            DailyReporting::firstOrCreate(
                [
                    'date' => $data['date'],
                    'branch_id' => $branchByName[$data['branch']]->id,
                    'batch_id' => $batchByName[$data['batch']]->id,
                ],
                [
                    'admission' => $data['admission'],
                    'opening_balance' => $data['opening_balance'],
                    'income_items' => $data['income_items'],
                    'expense_items' => $data['expense_items'],
                    'receipt_image' => null,
                    'bank_deposit_amount' => $data['bank_deposit_amount'],
                    'bank_deposit_slip' => null,
                    'cash_in_hand' => $data['cash_in_hand'],
                ]
            );
        });

        Banking::factory()->count(5)->create();

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
