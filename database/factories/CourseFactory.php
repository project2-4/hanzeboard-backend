<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            'ICTVT 2.2 Infrastructuren 2019-2020',
            'ICTVT 3. INTERNSHIP HBO-ICT September 2020-January 2021',
            'ICTVT SE 2.3 Software Engineering 2017-18',
            'ICTVT SE 2.3 Software Engineering 2019-2020',
            'ICTVT SE 2.4 Web & Mobile 2019-2020'
        ]),
        'is_public' => true
    ];
});
