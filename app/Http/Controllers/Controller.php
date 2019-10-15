<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $responseCodes = [
        'NO_DATA' => 'Nenhum investimento foi enviado para calcular.',
        'NO_TICKER' => 'Nenhum código de negociação (ticker) encontrado.',
        'TICKER_NOT_FOUND' => 'Não encontramos o ticker enviado na nossa base de cálculos.'
        'NO_AMOUNT' => 'Nenhuma quantidade de ações foi enviada.'
    ];

    public function formatError(String $responseCode, Int $statusCode) {

        $response = [
            'errors' => [
                'code' => $responseCode,
                'message' => $responseCodes[$responseCode] ?? 'Um erro inesperado ocorreu.',
                'status' => $statusCode,
            ]
        ];
        return response()->json($response, $statusCode);
    }
}
