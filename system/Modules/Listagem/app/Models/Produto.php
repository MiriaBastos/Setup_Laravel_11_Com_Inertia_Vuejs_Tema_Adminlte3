<?php

namespace Modules\Listagem\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'lis_produtos';

    public function lista()
    {
        return $this
            ->belongsTo(Lista::class, 'lista_id')
            ->select('id', 'nome');
    }

    public function rulesValidation()
    {
        return [
            'nome' => 'required',
            'preco' => 'required',
            'quantidade' => 'required',
        ];
    }

    public function salvar()
    {
        $this->save();
    }

    public static function getListaProdutosPorId($lista_id = null)
    {
        return self::where('lista_id', $lista_id)->get();
    }
}
