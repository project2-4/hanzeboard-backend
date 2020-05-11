<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Assignment;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            'Academic Writing',
            'Algoritmes & Data Structuren',
            'Computernetwerken',
            'Besturingssystemen',
            'Python'
        ]),
        'type' => 'numeric',
        'credits' => $faker->numberBetween(0, 5),
        'deadline' => now()->addDays(2),
        'subject_id' => function () {
            return factory(\App\Models\Subject::class)->create()->id;
        }
    ];
});
