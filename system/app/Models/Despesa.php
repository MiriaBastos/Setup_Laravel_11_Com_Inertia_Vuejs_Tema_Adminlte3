<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Despesa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'cli_despesas';

    public function validationRules()
    {
        $validation = [
            'categoria_id'  => 'required',
            'descricao'     => 'required',
            'dt_dia'        => 'required',
            'dt_mes'        => 'required',
            'dt_ano'        => 'required',
            'valor_despesa' => 'required',
        ];

        return $validation;
    }

    public function salvar() {
        $this->save();
    }

}
