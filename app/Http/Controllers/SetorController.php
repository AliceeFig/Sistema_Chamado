<?php

namespace App\Http\Controllers;

use App\Models\Setor;
use Illuminate\Http\Request;

class SetorController extends Controller
{
    public function index()
    {
        $setores = Setor::all();
        return view('setores.index', compact('setores'));
    }

    public function create()
    {
        return view('setores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:setores|max:255',
        ]);

        Setor::create($request->all());

        return redirect()->route('setores.index')->with('success', 'Setor criado com sucesso!');
    }

    public function edit($id)
    {
        $setor = Setor::findOrFail($id);
        return view('setores.edit', compact('setor'));
    }

    public function update(Request $request, $id)
    {
        $setor = Setor::findOrFail($id);

        // Validação
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $setor->update($request->only('nome'));

        return redirect()->route('setores.index')->with('success', 'Setor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $setor = Setor::findOrFail($id);
        $setor->delete();
        return redirect()->route('setores.index')->with('success', 'Setor excluído com sucesso!');
    }

}
