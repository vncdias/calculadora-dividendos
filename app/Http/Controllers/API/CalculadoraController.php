<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proventos;

class CalculadoraController extends Controller
{
    /**
     * Recebe os dados do frontend da calculadora e devolve
     * os proventos dos investimentos simulados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculaProventos(Request $request) {
        $input = $request->input() ?? [];
        
        if (empty($input)) {
            return $this->formatError('NO_DATA', 422);
        }
        foreach ($input as $key => $investimento) {
            if (empty($investimento['codigo'])) return $this->formarError('NO_TICKER', 422);
        }

    }
}
