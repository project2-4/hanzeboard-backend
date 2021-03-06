<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'infix' => null,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('secret'),
        'profile_type' => 'student',
        'profile_id' => factory(\App\Models\Student::class),
        'role_id' => function () {
            return \App\Models\Role::where('name', 'Student')->first()->id;
        },
        'remember_token' => Str::random(10),
    ];
});

$factory->state(App\Models\User::class, 'admin', [
    'email' => 'admin@hanze.nl',
    'role_id' => function () {
        return \App\Models\Role::where('name', 'Admin')->first()->id;
    }
]);

$factory->state(App\Models\User::class, 'teacher', [
    'role_id' => function () {
        return \App\Models\Role::where('name', 'Teacher')->first()->id;
    }
]);

$factory->state(App\Models\User::class, 'teaching-fellow', [
    'role_id' => function () {
        return \App\Models\Role::where('name', 'Teaching fellow')->first()->id;
    }
]);
