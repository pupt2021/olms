<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaterialsSubjectLinkSeeder extends Seeder
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
                'mat_id' => 1,
                'sub_id' => 1,
            ],
            [
                'mat_id' => 1,
                'sub_id' => 2,
            ],
            [
                'mat_id' => 2,
                'sub_id' => 2,
            ],
            [
                'mat_id' => 3,
                'sub_id' => 1,
            ],
            [
                'mat_id' => 3,
                'sub_id' => 2,
            ],
            [
                'mat_id' => 3,
                'sub_id' => 3,
            ],
            [
                'mat_id' => 4,
                'sub_id' => 1,
            ],
            [
                'mat_id' => 5,
                'sub_id' => 1,
            ],
            [
                'mat_id' => 5,
                'sub_id' => 2,
            ],
            [
                'mat_id' => 5,
                'sub_id' => 3,
            ],
            [
                'mat_id' => 21,
                'sub_id' => 4,
            ],
            [
                'mat_id' => 22,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 23,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 24,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 25,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 26,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 27,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 28,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 29,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 30,
                'sub_id' => 11,
            ],
            [
                'mat_id' => 31,
                'sub_id' => 5,
            ],
        ];
        DB::table('materials_subject_link')->insert($data);
    }
}
