<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenaltySettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'penalty_days' => 3,
                'penalty_fee' => 10.00,
            ],
        ];
        
        DB::table('penalty_settings')->insert($data);
    }
}
