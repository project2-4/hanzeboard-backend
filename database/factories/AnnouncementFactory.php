<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Announcement;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6, true),
        'content' => $faker->paragraph(5, true),
        'credits' => $faker->numberBetween(0, 5),
        'posted_by' => function () {
            return factory(\App\Models\Staff::class)->create()->id;
        },
        'course_id' => function () {
            return factory(\App\Models\Announcement::class)->create()->id;
        }
    ];
});
