<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'student_number' => $faker->unique()->randomNumber(6, true),
       'group_id' => factory(\App\Models\Group::class)
    ];
});
