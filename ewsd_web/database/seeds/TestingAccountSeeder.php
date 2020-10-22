<?php

use Illuminate\Database\Seeder;

class TestingAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(){
    	$faker = \Faker\Factory::create();

          DB::table('users')->insert([
          	[
	          	'username' => $faker->userName,
				'fullname' => $faker->name,
				'email' => "admin@gmail.com",
				'role_id' => 1,
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'image' => $faker->image,
				'remember_token' => Str::random(10),
        	],

        	[
	          	'username' => $faker->userName,
				'fullname' => $faker->name,
				'email' => "marketingmanager@gmail.com",
				'role_id' => 2,
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'image' => $faker->image,
				'remember_token' => Str::random(10),
        	],

        	[
	          	'username' => $faker->userName,
				'fullname' => $faker->name,
				'email' => "marketingcoordinor@gmail.com",
				'role_id' => 3,
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'image' => $faker->image,
				'remember_token' => Str::random(10),
        	],

        	[
	          	'username' => $faker->userName,
				'fullname' => $faker->name,
				'email' => "student@gmail.com",
				'role_id' => 4,
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'image' => $faker->image,
				'remember_token' => Str::random(10),
        	],

        	[
	          	'username' => $faker->userName,
				'fullname' => $faker->name,
				'email' => "guest@gmail.com",
				'role_id' => 5,
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'image' => $faker->image,
				'remember_token' => Str::random(10),
        	]
        ]);
    }
}
