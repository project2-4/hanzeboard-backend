<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Announcement;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6, true),
        'content' => $faker->paragraph(5, true),
        'posted_by' => factory(\App\Models\Staff::class),
        //'course_id' => factory(\App\Models\Course::class)
    ];
});
