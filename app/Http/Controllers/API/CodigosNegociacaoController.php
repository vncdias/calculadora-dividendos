<?php

namespace App\Http\Controllers\API;

use App\CodigosNegociacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodigosNegociacaoController extends Controller
{
    /**
     * Retorna lista de códigos de negociação
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return array('data' => \App\CodigosNegociacao::all());
    }
}
