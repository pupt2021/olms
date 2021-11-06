<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
