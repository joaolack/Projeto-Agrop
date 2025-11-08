<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdutoController extends Controller
{
    public function index()
    {   
        $produtos = Produto::with('categoria')->orderBy('nome')->paginate(10);
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        

        $categorias = Categoria::all();
        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        
        
        $validated = $request->validate([
            'nome' => ['required','string','max:150', Rule::unique('produtos', 'nome')],
            'descricao' => ['nullable', 'string'],
            'preco_venda' => ['required', 'numeric', 'min:0.01'],
            'preco_custo' => ['required', 'numeric', 'min:0.'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'quant_estoque' => ['required', 'integer', 'min:0'],
            'estoque_min' => ['required', 'integer', 'min:0'],
            'data_validade' => ['nullable', 'date', 'after:today'],
            
        ]);

        Produto::create($validated);

        return redirect()->route('produtos.index')
                       ->with('success', '📦 Produto cadastrado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco_venda' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'quant_estoque' => 'required|integer|min:0',
        ]);

        $produto->update($validated);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso');

    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso');
    }
}
