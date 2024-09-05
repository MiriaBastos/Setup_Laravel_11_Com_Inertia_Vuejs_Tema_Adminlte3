<?php

namespace Modules\Listagem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\Listagem\Models\Lista;
use Modules\Listagem\Models\Produto;

class ListagemController extends Controller
{
    public function index($lista_id = 0)
    {
        $listaCompras = Lista::getlistaComprasPorUser(Auth::user()->id);

        $vars = [
            'listaCompras' => $listaCompras,
            'listaId' => $lista_id
        ];

        return inertia('Master/listagem/lista-compras/index', $vars);
    }

    public function cadastrar(Request $request)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        $lista = new Lista();
        $lista->user_id = Auth::user()->id;
        $lista->nome = $request->nome;

        if($lista->save()) {
            return to_route('listagem.index');
        }

        return to_route('listagem.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        $lista = Lista::find($request->lista_id);

        $lista->user_id = $lista->user_id;
        $lista->nome = $request->nome;

        if($lista->save()) {
            return to_route('listagem.index');
        }

        return to_route('listagem.index');
    }

    public function excluir($id)
    {
        $lista = Lista::find($id);

        if(!$lista) {
            return redirect()->back()->withErrors('Lista não encontrada.');
        }

        DB::beginTransaction();

        try {
            $produtos = Produto::where('lista_id', $id)->get();
            foreach ($produtos as $produto) {
                $produto->delete();
            }

            $lista->delete();

            DB::commit();

            return to_route('listagem.index')->with('success', 'Lista e produtos excluídos com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors('Erro ao tentar excluir a lista.');
        }
    }

}
