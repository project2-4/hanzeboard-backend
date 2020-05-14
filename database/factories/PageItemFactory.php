<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PageItem;
use Faker\Generator as Faker;

$factory->define(PageItem::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6, true),
        'type' => 'text',
        'content' => $faker->paragraph(5, true),
        'page_id' => factory(\App\Models\Page::class)
    ];
});
