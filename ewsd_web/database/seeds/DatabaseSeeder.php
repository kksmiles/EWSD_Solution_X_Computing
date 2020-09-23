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
        $this->call(AcademicYearSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FacultySeeder::class);
    }
}
