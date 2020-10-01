<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    static $used_roles = [];
    $role = $faker->numberBetween($min=1, $max =5);
    while(($role ==1 && in_array('1', $used_roles))|| ($role ==2 && in_array('2', $used_roles))){
        $role = $faker->numberBetween($min=1 ,$max=5);
    }
    $used_roles[] = $role;
    return [
        'username' => $faker->userName,
        'fullname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role_id' => $role,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'image' => $faker->imageUrl,
        'remember_token' => Str::random(10),
    ];
});
