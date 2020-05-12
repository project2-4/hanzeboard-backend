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
        'assignment_id' => factory(\App\Models\Assignment::class),
        'student_id' => factory(\App\Models\Student::class),
        'recorded_by' => factory(\App\Models\Staff::class),
    ];
});
