<?php

use Illuminate\Database\Seeder;

class ValidationScenario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    private function criaDadosCompanhia($companhia) {
        $faker = Faker\Factory::create();
        $codigo = strtoupper($faker->lexify('????'));
        $num_proventos = $faker->numberBetween(10, 100);

        factory(App\CodigosNegociacao::class)->create([
            'codigo' => $codigo . '3',
            'companhia_id' => $companhia->id,
        ]);
        factory(App\CodigosNegociacao::class)->create([
            'codigo' => $codigo . '4',
            'companhia_id' => $companhia->id,
        ]);

        factory(App\Proventos::class, $num_proventos)->create([
            'companhia_id' => $companhia->id,
        ]);
    }

    public function run()
    {
        $faker = Faker\Factory::create();
        $num_companhias = $faker->numberBetween(1, 10);
        factory(App\Companhia::class, $num_companhias)->create()->each(function ($companhia) {
            $this->criaDadosCompanhia($companhia);
        });
        //
    }
}
