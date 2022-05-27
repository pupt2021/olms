<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserRoleSeeder extends Seeder
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
                'role_name' => 'Administrator',
                'role_description' => NULL,
                'role_landing' => NULL,
                'role_status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ],
            [
                'role_name' => 'Teacher',
                'role_description' => NULL,
                'role_landing' => NULL,
                'role_status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ],
            [
                'role_name' => 'Student',
                'role_description' => NULL,
                'role_landing' => NULL,
                'role_status' => 1,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ],
        ];
        
        DB::table('user_role')->insert($data);
    }
}
