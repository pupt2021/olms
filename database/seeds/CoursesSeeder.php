<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CoursesSeeder extends Seeder
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
                'course_name' => 'DICT',
                'course_description' => 'Diploma in Information Communication Technology',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSIT',
                'course_description' => 'Bachelor of Science in Information Technology',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSECE',
                'course_description' => 'Bachelor of Science in Electronics Engineering',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSME',
                'course_description' => 'Bachelor of Science in Mechanical Engineering',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSA',
                'course_description' => 'Bachelor of Science in Accountancy',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSBA',
                'course_description' => 'Bachelor of Science in Business Administration',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSAM',
                'course_description' => 'Bachelor of Science in Applied Mathematics',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSENTREP',
                'course_description' => 'Bachelor of Science in Entrepreneurship',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSED',
                'course_description' => 'Bachelor in Secondary Education',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'BSOA',
                'course_description' => 'Bachelor of Science in Office Administration',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'course_name' => 'DOMT',
                'course_description' => 'Diploma in Office Management Technology',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
        ];
        
        DB::table('courses')->insert($data);
    }
}
