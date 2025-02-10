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
        $saldo = $item_id->quantidade - $item_id->premios_entregues;

        if ( $quantidade > $saldo) {
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

    public function update(Request $request)
{

    $estoque = Estoque::findOrFail($request->id);

    if ($request->quantidade < $estoque->premios_entregues) {
        return redirect('/estoque')->with('error', 'O estoque inicial  não pode ser alterado para menor que os prêmios entregues.');
    }

    $estoque->nome = $request->nome;
    $estoque->quantidade = $request->quantidade;
    $estoque->save();

    return redirect('/estoque')->with('success', 'Prêmio atualizado com sucesso!');
}




}
