<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserRoles;

$factory->define(UserRoles::class, function () {
    static $roles = [
        'Admin',
        'Marketing Manager',
        'Marketing Coordinator',
        'Student',
        'Guest',
    ];
    static $i=0;
    return [
        'roles' => $roles[$i++]
    ];
});
