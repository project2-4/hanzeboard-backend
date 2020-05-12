<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Staff;
use Faker\Generator as Faker;

$factory->define(Staff::class, function (Faker $faker) {
    return [
        'abbreviation' => strtoupper(Str::random(4)),
        'status' => 'default',
        'office_location' => $faker->lexify('Zernikeplein 11 ?.###')
    ];
});
