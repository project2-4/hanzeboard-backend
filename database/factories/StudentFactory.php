<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'class_id' => function () {
            return factory(\App\Models\Group::class)->create()->id;
        }
    ];
});
