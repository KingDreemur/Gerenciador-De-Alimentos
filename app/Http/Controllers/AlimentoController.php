<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AlimentoController extends Controller
{
    public function index()
{
    $alimentos = Alimento::with('categoria')->get();
    return view('alimentos.index', compact('alimentos'));
}


    public function create()
    {
        $categorias = Categoria::all();
        return view('alimentos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'validade' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Alimento::create($request->all());

        return redirect()->route('alimentos.index')->with('success', 'Alimento criado com sucesso.');
    }

    public function show($id)
    {
        $alimento = Alimento::with('categoria')->findOrFail($id);
        return view('alimentos.show', compact('alimento'));
    }

    public function edit($id)
    {
        $alimento = Alimento::findOrFail($id);
        $categorias = Categoria::all();
        return view('alimentos.edit', compact('alimento', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'validade' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $alimento = Alimento::findOrFail($id);
        $alimento->update($request->all());

        return redirect()->route('alimentos.index')->with('success', 'Alimento atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $alimento = Alimento::findOrFail($id);
        $alimento->delete();

        return redirect()->route('alimentos.index')->with('success', 'Alimento excluído com sucesso.');
    }

    // Função para alimentos com validade próxima
    public function validadeProxima()
    {
        $hoje = Carbon::now();
        $limite = $hoje->copy()->addDays(7);

        $alimentos = Alimento::whereBetween('validade', [$hoje->toDateString(), $limite->toDateString()])
            ->orderBy('validade', 'asc')
            ->get();

        return view('alimentos.validade_proxima', compact('alimentos'));
    }

    // Função para alimentos com estoque baixo
    public function estoqueBaixo()
    {
        $limite = 5;
        $alimentos = Alimento::where('quantidade', '<', $limite)
            ->orderBy('quantidade', 'asc')
            ->get();

        return view('alimentos.estoque_baixo', compact('alimentos'));
    }
}
