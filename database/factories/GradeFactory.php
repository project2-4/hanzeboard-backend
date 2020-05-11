<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            'Academic Writing',
            'Algoritmes & Data Structuren',
            'Computernetwerken',
            'Besturingssystemen',
            'Python'
        ]),
        'grade' => $faker->randomFloat(0.0, 10.0),
        'assignment_id' => function () {
            return factory(\App\Models\Assignment::class)->create()->id;
        },
        'student_id' => function () {
            return factory(\App\Models\Student::class)->create()->id;
        },
        'recorded_by' => function () {
            return factory(\App\Models\Staff::class)->create()->id;
        },
    ];
});
