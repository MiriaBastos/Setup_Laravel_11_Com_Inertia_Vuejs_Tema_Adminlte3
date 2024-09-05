<?php

namespace Modules\Listagem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Listagem\Models\Lista;
use Modules\Listagem\Models\Produto;
use Modules\Listagem\Models\Setor;

class ListagemProdutosController extends Controller
{
    public function index($id)
    {
        $lista = Lista::find($id);

        $produtoLista = Produto::getListaProdutosPorId($id);
        $dropDownSetor = Setor::dropDownSetor();

        $vars = [
            'produtoLista' => $produtoLista,
            'dropDownSetor' => $dropDownSetor,
            'lista' => $lista
        ];

        return inertia('Master/listagem/lista-produtos/index', $vars);
    }

    public function cadastrar(Request $request)
    {
        $produto = new Produto();

        $produto->lista_id    = $request->lista_id;
        $produto->setor_id    = $request->setor_id;
        $produto->nome        = $request->nome;
        $produto->quantidade  = $request->quantidade;
        $produto->valor       = $request->valor;

        $produto->salvar();

        return to_route('lista-produto.index', [
            'id' => $produto->lista_id
        ]);
    }

    public function update(Request $request)
    {
        $produto = Produto::find($request->produto_id);

        $produto->lista_id    = $request->lista_id;
        $produto->setor_id    = $request->setor_id;
        $produto->nome        = $request->nome;
        $produto->quantidade  = $request->quantidade;
        $produto->valor       = $request->valor;

        $produto->salvar();

        return to_route('lista-produto.index', [
            'id' => $produto->lista_id
        ]);
    }

    public function excluirMarcados(Request $request)
    {
        $ids = $request->input('ids', []);
        Produto::whereIn('id', $ids)->delete();

        return redirect()->back()->with('produtoLista', Produto::all());
    }

}
