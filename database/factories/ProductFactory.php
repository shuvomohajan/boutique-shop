<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Product::class, function (Faker $faker) {
    $sub = App\Model\Subject::pluck('id')->toArray();
    $format = App\Model\Format::pluck('id')->toArray();
    $language = App\Model\Language::pluck('id')->toArray();
    $publisher = App\User::where('type', 'publisher')->pluck('id')->toArray();
    $author = App\User::where('type', 'author')->pluck('id')->toArray();

    return [
        'name'            => $faker->name,
        'year'            => $faker->year,
        'regular_price'   => random_int('100', '500'),
        'stock'           => random_int('0', '10'),
        'subject_id'      => $faker->randomElement($sub),
        'publisher_id'    => $faker->randomElement($publisher),
        'author_id'       => $faker->randomElement($author),
        'format_id'       => $faker->randomElement($format),
        'language_id'     => $faker->randomElement($language),
    ];
});
