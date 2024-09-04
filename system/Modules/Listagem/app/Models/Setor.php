<?php

namespace Modules\Listagem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Listagem\Database\Factories\ListaFactory;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'lis_setores';

    public static function dropDownSetor()
    {
        return self::where('status', 1)
                        ->pluck('nome', 'id')
                        ->toArray();
    }
}
