<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserFaculty;
use Faker\Generator as Faker;

$factory->define(UserFaculty::class, function (Faker $faker) {
    static $combos = [];
    $user_id = $faker->numberBetween($min=1, $max=10);
    $faculty_id = $faker->numberBetween($min=1, $max=10);

    while(in_array([$faculty_id, $user_id],$combos)) {
        $faculty_id = $faker->numberBetween($min=1, $max=10);
        $user_id = $faker->numberBetween($min=1, $max=10);
    }
    $combos[] = [$faculty_id , $user_id];
    return [
        'faculty_id' => $faculty_id,
        'user_id' => $user_id
    ];
});
