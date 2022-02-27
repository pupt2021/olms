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
                'background_color' => '#adff2f',
                'text_color' => '#000000',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Science',
                'status' => 1,
                'background_color' => '#00FF00',
                'text_color' => '#ffffff',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Mathematics',
                'status' => 1,
                'background_color' => '#FF0000',
                'text_color' => '#ffffff',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Chemistry',
                'status' => 1,
                'background_color' => '#90EE90',
                'text_color' => '#000000',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                
                'subject_name' => 'Business',
                'status' => 1,
                'background_color' => '#008080',
                'text_color' => '#ffffff',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Physical, Educational, and Health',
                'status' => 1,
                'background_color' => '#b9711e',
                'text_color' => '#ffffff',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'History',
                'status' => 1,
                'background_color' => '#FFFF00',
                'text_color' => '#000000',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Social Studies',
                'status' => 1,
                'background_color' => '#FFA500',
                'text_color' => '#ffffff',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Algebra',
                'status' => 1,
                'background_color' => '#ffcccb',
                'text_color' => '#000000',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Programming',
                'status' => 1,
                'background_color' => '#00FFFF',
                'text_color' => '#000000',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'IT',
                'status' => 1,
                'background_color' => '#0000FF',
                'text_color' => '#ffffff',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'subject_name' => 'Engineering',
                'status' => 1,
                'background_color' => '#A020F0',
                'text_color' => '#ffffff',
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
        ];
        DB::table('materials_subject')->insert($data);
    }
}
