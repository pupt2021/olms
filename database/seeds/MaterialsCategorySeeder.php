<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaterialsCategorySeeder extends Seeder
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
                'cat_structure' => 'PUPT Circ',
                'cat_description' => 'Circulation',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'cat_structure' => 'PUPT Eb',
                'cat_description' => 'Ebook',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'cat_structure' => 'PUPT Feas',
                'cat_description' => 'Feasibility',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'cat_structure' => 'PUPT Fili',
                'cat_description' => 'Filipiñana',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'cat_structure' => 'PUPT TH/D',
                'cat_description' => 'Theses and Dissertations',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'cat_structure' => 'PUPT Ref',
                'cat_description' => 'Reference',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'cat_structure' => 'PUPT Don',
                'cat_description' => 'Donation',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
            [
                'cat_structure' => 'PUPT Fic',
                'cat_description' => 'Fiction',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL
            ],
        ];
        DB::table('materials_category')->insert($data);
    }
}
