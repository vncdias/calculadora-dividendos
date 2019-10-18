<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proventos;
use App\CodigosNegociacao;
use App\Http\Requests\CalculadoraRequest;

class CalculadoraController extends Controller
{
    /**
     * Recebe os dados do frontend da calculadora e devolve
     * os proventos dos investimentos simulados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculaProventos(CalculadoraRequest $request) {
        $validated = $request->validated();

        if ($validated) {
            $retorno = [
                'resultado' => [],
                'total' => 0,
            ];
            
            foreach ($request['investimentos'] as $key => $investimento) {
                $codigo = CodigosNegociacao::where('codigo', $investimento['codigo'])->first();
                if (!$codigo) return $this->formatError('TICKER_NOT_FOUND', 404);
                
                $proventos = Proventos::buscarProventos(
                    $codigo['companhia_id'], substr($investimento['codigo'], -1), $investimento['data_inicial'], $investimento['data_final']
                );

                $resultado = [
                    'codigo' => $investimento['codigo'],
                    'tabela' => [],
                    'total' => 0,
                ];

                foreach ($proventos as $provento) {
                    $resultadoProvento = $this->formataResultados($provento, $investimento['quantidade']);
                    $resultado['tabela'][] = $resultadoProvento;
                    $resultado['total'] += $resultadoProvento['valor_liquido'];
                    $resultado['total'] = round($resultado['total'], 2);
                }

                $retorno['resultado'][] = $resultado;
                $retorno['total'] += round($resultado['total'], 2);
            }

            return response()->json(array('data' => $retorno));
        }
    }

    private function formataResultados($provento, $quantidade) {
        switch ($provento['tipo_provento']) {
            case 'DIVIDENDO':
                $tipo_proventos = 'Dividendos';
                break;
        
            case 'JCP':
                $tipo_proventos = 'Juros sobre Capital Próprio (JCP)';
                break;
        
            default:
                $tipo_proventos = '';
                break;
        }

        return [
            'data_ex' => $provento['data_aprovacao'],
            'tipo_provento' => $tipo_proventos,
            'quantidade' => $quantidade,
            'valor_por_acao' => floatval($provento['valor_provento']),
            'data_pagamento' => $provento['data_ultimo_preco'],
            'valor_bruto' => round($provento['valor_provento'] * $quantidade, 2),
            'valor_liquido' => round($provento['valor_provento'] * $quantidade, 2),
        ];
    }
}
