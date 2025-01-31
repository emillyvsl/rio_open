<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoque = Estoque::all();
        return view('estoque', compact('estoque'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required',
        ]);

        $estoque = new Estoque([
            'nome' => $request->get('item_name'),
            'quantidade' => $request->get('quantity'),
        ]);

        $estoque->save();
        return redirect('/estoque')->with('success', 'Premio adicionado com sucesso!');
    }

    public function remover(Request $request)
    {
        $item_id = Estoque::find($request->item);
        $quantidade = $request->get('quantidade');

        if ($quantidade > $item_id->quantidade) {
            return redirect('/estoque')->with('error', 'Quantidade maior que a disponível!');
        }

        $item_id->premios_entregues += $quantidade;

        $item_id->save();

        return redirect('/estoque')->with('success', 'Premio removido com sucesso!');
    }

    public function destroy(Request $request)
    {
        $estoque = Estoque::find($request->item);

        if ($estoque) {
            $estoque->delete();
            return redirect('/estoque')->with('success', 'Premio deletado com sucesso!');
        }

        return redirect('/estoque')->with('error', 'Item não encontrado!');
    }



}
