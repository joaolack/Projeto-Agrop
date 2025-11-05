<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        //1. Dados de alerta: estoque baixo ou em falta
        $estoqueCritico = Produto::whereColumn('quant_estoque', '<=', 'estoque_min')
                                   ->with('categoria')
                                   ->orderBy('quant_estoque', 'asc')
                                   ->get();
                                   
        //2. Dados de alerta: produtos com validade próxima (30 dias)
        $vencimentoProximo = Produto::whereNotNull('data_validade')
                                    ->whereDate('data_validade', '<=', Carbon::now()->addDays(60)) // Produtos que vencem em 60 dias
                                    ->orderBy('data_validade', 'asc')
                                    ->get();
        
        //3. Estatísticas gerais
        $totalProdutos = Produto::count();
        $produtosEmFalta = Produto::where('quant_estoque', 0)->count();

        //4. Valor total do estoque
        $valorTotalEstoque = Produto::select(DB::raw('SUM(preco_custo * quant_estoque) as total_custo'))
                                      ->value('total_custo') ?? 0;

        return view('dashboard', compact(
            'estoqueCritico', 
            'vencimentoProximo', 
            'totalProdutos', 
            'produtosEmFalta', 
            'valorTotalEstoque'
        ));                              
    }
}
