<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlanoPrecos extends Model
{
    protected $table = 'planos_precos';
    protected $timestamp = false;
    protected $fillabel = [
        'id_plano','idade_inicio', 'idade_fim', 'preco', 'vl_comissao', 'qt_comissao', 'status' 
    ];
}
