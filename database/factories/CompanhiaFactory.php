<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Companhia;
use Faker\Generator as Faker;

$factory->define(Companhia::class, function (Faker $faker) {
    return [
        //'id' => $faker->randomNumber(3),
        'nome' => $faker->company,
        'cvm' => $faker->randomNumber(5),
    ];
});
