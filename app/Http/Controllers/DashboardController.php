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
        $estoqueCritico = Produto::whereColumn('quant_estoque', '<=', 'estoque_min')
                                   ->with('categoria')
                                   ->orderBy('quant_estoque', 'asc')
                                   ->get();
                                   
        $vencimentoProximo = Produto::whereNotNull('data_validade')
            ->whereDate('data_validade', '>=', Carbon::now()->startOfDay())
            ->whereDate('data_validade', '<=', Carbon::now()->addDays(60)->endOfDay())   
            ->orderBy('data_validade', 'asc')
            ->get();
        
        $totalProdutos = Produto::count();
        $produtosEmFalta = Produto::where('quant_estoque', 0)->count();

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
