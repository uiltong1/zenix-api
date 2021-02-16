<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $fillable = ['cliente', 'funcionario', 'tipo', 'observacao', 'data_execucao'];
    protected $table = 'atendimento';
}
