<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Staff;
use Faker\Generator as Faker;

$factory->define(Staff::class, function (Faker $faker) {
    return [
        'abbreviation' => strtoupper(Str::random(4)),
        'office_location' => $faker->lexify('Zernikeplein 11 ?.###'),
        'staff_status_id' => factory(\App\Models\StaffStatus::class)
    ];
});
