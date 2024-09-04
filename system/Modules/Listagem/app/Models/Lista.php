<?php

namespace Modules\Listagem\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Listagem\Database\Factories\ListaFactory;

class Lista extends Model
{
    use HasFactory;

    protected $table = 'lis_listas';

    public function usuario()
    {
        return $this
            ->belongsTo(User::class, 'user_id')
            ->select('id', 'nome');
    }

    public function salvar()
    {
        $this->save();
    }

    public static function getlistaComprasPorUser($user_id)
    {
        return self::where('user_id', $user_id)
            ->get();
    }
}
