<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name'    => $faker->name,
        'details' => $faker->sentence,
    ];
});
