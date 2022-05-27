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
        $this->call([
            // Reference Tables (does not rely on other tables for FK/PK)
            MaterialsCategorySeeder::class,
            MaterialsSubjectSeeder::class,
            CoursesSeeder::class,
            GenderSeeder::class,
            UserRoleSeeder::class,
            PenaltySettingsSeeder::class,

            // Table that references the tables seeded above
            MaterialsSeeder::class,
            UserLinksParentSeeder::class,
            UserLinksSeeder::class,
            UserSeeder::class,
            UserPermissionsSeeder::class,
            UserDetailsSeeder::class,

            //
            MaterialsSubjectLinkSeeder::class,


        ]);
    }
}
