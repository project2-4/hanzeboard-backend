<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => implode(' ', $faker->words(5)),
        //'course_id' => factory(\App\Models\Course::class)
    ];
});
