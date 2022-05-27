<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenderSeeder extends Seeder
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
                'gender_name' => 'Male',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
            [
                'gender_name' => 'Female',
                'status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
                'deleted_at' => NULL,
            ],
        ];
        
        DB::table('gender')->insert($data);
    }
}
