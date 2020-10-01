<?php

use Illuminate\Database\Seeder;

class UserFacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserFaculty::class, 80)->create();
    }
}
