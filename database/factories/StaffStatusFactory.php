<?php

/** @var Factory $factory */

use App\Models\Staff;
use App\Models\StaffStatus;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(StaffStatus::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(['available', 'leave', 'sick']),
        'until' => $faker->dateTimeThisMonth()
    ];
});
