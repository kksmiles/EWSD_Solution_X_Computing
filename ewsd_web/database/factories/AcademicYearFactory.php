<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AcademicYear;
use Faker\Generator as Faker;

$factory->define(AcademicYear::class, function (Faker $faker) {
    return [
        'title' => $faker->year($max = 'now'),
        'description' => $faker->sentence,
        'closure_date' => $faker->dateTimeThisYear
    ];
});
