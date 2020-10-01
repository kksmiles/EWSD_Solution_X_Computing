<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Faculty;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    static $names = [   
        'Faculty of Business Information Technology',
        'Faculty of Computer Science',
        'Faculty of Knowledge Engineering',
        'Faculty of Artificial Intelligence',
        'Faculty of Natural Language Processing',
        'Faculty of Business Analysis',
        'Faculty of Business Intelligence',
        'Faculty of Software Engineering',
        'Faculty of Enterprise Web',
        'Faculty of Networking'
    ];
    $name = $names[$faker->unique()->numberBetween($min=0, $max=9)];

    return [
        'name' => $name,
        'description' => $faker->sentence
    ];
});
