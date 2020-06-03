<?php

/** @var Factory $factory */

use App\Models\Page;
use App\Models\Subject;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => implode(' ', $faker->words(5)),
        'page_id' => factory(Page::class)
    ];
});
