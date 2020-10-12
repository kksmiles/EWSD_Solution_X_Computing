<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MagazineIssue;
use Faker\Generator as Faker;


$factory->define(MagazineIssue::class, function (Faker $faker) {
    static $titles = [   
        'Issue 1',
        'Issue 2',
        'Issue 3',
        'Issue 4',
        'Issue 5',
    ];
    static $description = 'No.1 Description of the Issue is the issue description and Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tincidunt dui eget nulla pretium, sed faucibus diam dictum.';
    $title = $titles[$faker->numberBetween($min=0, $max=4)];

    return [
        'staff_id' => rand(1,3),
        'faculty_id' => rand(1,3),
        'academic_year_id' => rand(1,3),
        'title' => $title,
        'description' => $description,
        'image' => $faker->imageUrl,
        'file' => $faker->imageUrl,
        'submission_closure_date' => $faker->dateTime,
        'modification_closure_date' => $faker->dateTime,
    ];
});
