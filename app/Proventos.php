<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proventos extends Model
{
    protected $table = 'proventos';

    private static function identificaTipoAtivo($final_ticker) {
        switch ($final_ticker) {
            case '3':
                return 'ON';
                break;
            
            case '4':
                return 'PN';
                break;
            
            default:
                return null;
                break;
        }
    }

    public static function buscarProventos($companhia_id, $final_ticker, $data_inicial, $data_final) {
        $tipo_ativo = self::identificaTipoAtivo($final_ticker);

        $where = [
            'companhia_id' => $companhia_id,
        ];

        if (!empty($tipo_ativo)) $where['tipo_ativo'] = $tipo_ativo;

        return self::where($where)
            ->whereBetween('data_ultimo_preco', [date($data_inicial), date($data_final)])
            ->orderBy('data_aprovacao', 'ASC')
            ->get();
    }
}
