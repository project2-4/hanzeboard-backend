<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            'Academic Writing',
            'Algoritmes & Data Structuren',
            'Computernetwerken',
            'Besturingssystemen',
            'Python'
        ]),
        'course_id' => function () {
            return factory(\App\Models\Course::class)->create()->id;
        }
    ];
});
