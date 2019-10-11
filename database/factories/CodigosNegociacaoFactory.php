<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CodigosNegociacao;
use Faker\Generator as Faker;

$factory->define(CodigosNegociacao::class, function (Faker $faker) {
    $companhia = factory(\App\Companhia::class)->make();
    return [
        //'id' => $faker->randomNumber(3),
        'companhia_id' => $companhia->id,
        'codigo' => strtoupper($faker->lexify('????')) . $faker->numberBetween(3, 4),
    ];
});
