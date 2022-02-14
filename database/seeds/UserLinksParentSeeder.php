<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLinksParentSeeder extends Seeder
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
                'user_link_parent_name' => 'Users',
                'icon' => 'fa-user',
                'user_role' => 1,
            ],
            [
                'user_link_parent_name' => 'Materials',
                'icon' => 'fa-boxes',
                'user_role' => 1,
            ],
            [
                'user_link_parent_name' => 'Borrowing',
                'icon' => 'fa-clipboard-check',
                'user_role' => 1,
            ],
            [
                'user_link_parent_name' => 'Penalty Management',
                'icon' => 'fa-window-close',
                'user_role' => 1,
            ],
            [
                'user_link_parent_name' => 'Users Information',
                'icon' => 'fa-user',
                'user_role' => 2,
            ],
            [
                'user_link_parent_name' => 'Archives',
                'icon' => 'fa-archive',
                'user_role' => 1,
            ],
        ];
        
        DB::table('user_links_parent')->insert($data);
    }
}
