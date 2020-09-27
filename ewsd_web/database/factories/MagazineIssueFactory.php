<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MagazineIssue;
use Faker\Generator as Faker;

$factory->define(MagazineIssue::class, function (Faker $faker) {
    return [
        'staff_id' => rand(1,3),
        'faculty_id' => rand(1,3),
        'academic_year_id' => rand(1,3),
        'title' => $faker->word,
        'description' => $faker->sentence,
        'image' => $faker->image,
        'file' => $faker->image,
        'submission_closure_date' => $faker->dateTime,
        'modification_closure_date' => $faker->dateTime,
    ];
});
