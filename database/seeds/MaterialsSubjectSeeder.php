<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaterialsSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();
        $data = [
            [
                'subject_name' => 'Philosophy',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Science',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Mathematics',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Chemistry',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Business',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Physical, Educational, and Health',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'History',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Social Studies',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Algebra',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Programming',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'IT',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Engineering',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
        ];
        DB::table('materials_subject')->insert($data);
    }
}
