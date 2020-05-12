<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(6, true),
        'content' => $faker->paragraph(5, true),
        'parent_page_id' => null,
        //'course_id' => factory(\App\Models\Course::class)
    ];
});
