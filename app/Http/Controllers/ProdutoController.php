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
            'nome' => ['required', 'string', 'max:150', Rule::unique('produtos', 'nome')->ignore($produto->id)],
            'descricao' => ['nullable', 'string'],
            'preco_venda' => ['required', 'numeric', 'min:0.01'],
            'preco_custo' => ['required', 'numeric', 'min:0'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'estoque_min' => ['required', 'integer', 'min:0'],
            'data_validade' => ['nullable', 'date', 'after:today'],
        ]);

        $produto->update($validated);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso');

    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso');
    }

    public function moveEstoque(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'quantidade' => ['required', 'integer', 'min:1'],
            'operacao' => ['required', 'in:entrada,saida'],
        ]);

        $quantidade = $validated['quantidade'];
        $operacao = $validated['operacao'];

        $request->session()->flash('operacao', $operacao);

        if ($operacao === 'entrada') {
            $produto->quant_estoque += $quantidade;
            $mensagem = "✅ Entrada de **{$quantidade}** unidades de {$produto->nome} registrada com sucesso!";
        
        } elseif ($operacao === 'saida') {
            if ($produto->quant_estoque < $quantidade) {
                return back()->withErrors(['quantidade' => 'A quantidade de saída não pode ser maior que o estoque atual (' . $produto->quant_estoque . ').'])
                        ->withInput();
            }
            $produto->quant_estoque -= $quantidade;
            $mensagem = "✅ Saída de **{$quantidade}** unidades de {$produto->nome} registrada com sucesso!";
        }

        $produto->save();
        return redirect()->route('produtos.edit', $produto->id)->with('sucess', $mensagem);
    }
}
