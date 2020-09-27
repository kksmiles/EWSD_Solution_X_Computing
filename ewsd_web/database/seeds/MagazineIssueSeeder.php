<?php

use Illuminate\Database\Seeder;

class MagazineIssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MagazineIssue::class, 10)->create();
    }
}
