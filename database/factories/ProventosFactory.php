<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Proventos;
use Faker\Generator as Faker;

$factory->define(Proventos::class, function (Faker $faker) {
    $companhia = factory(\App\Companhia::class)->make();
    $tipos_ativos = ['ON', 'PN'];
    $tipos_proventos = ['DIVIDENDO', 'JCP'];
    $data_aleatoria = $faker->dateTimeBetween('-2 years', 'now', null);
    return [
        //'id' => $faker->randomNumber(3),
        'companhia_id' => $companhia->id,
        'tipo_ativo' => $faker->randomElement($tipos_ativos),
        'tipo_provento' => $faker->randomElement($tipos_proventos),
        'valor_provento' => $faker->randomFloat(6, 0, 0.5),
        'data_aprovacao' => $data_aleatoria,
        'data_ultimo_preco' => $data_aleatoria,
        'ultimo_preco' => $faker->randomFloat(2, 5, 25),
    ];
});
