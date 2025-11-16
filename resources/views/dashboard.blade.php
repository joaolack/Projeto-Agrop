@extends('layouts.app')

@section('slot')
<div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">
        {{ __('Início (Dashboard)') }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="card bg-white p-6 rounded-lg shado-md border-l-4 border-indigo-500">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Produtos Cadastrados</p>
            <p class="text-3xl font-bold text-gray-900"> {{ number_format($totalProdutos, 0, ',', '.')}}</p>
        </div>

        <div class="card bg-white p-6 rounded-lg shadow-md border-l-4 border-red-500">
            <p class="text-sm font-medium text-gray-500">Produtos Em Falta (Zero)</p>
            <p class="text-3xl font-bold text-red-500">{{ $produtosEmFalta}}</p>
        </div>

        <div class="card bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-500">Valor Total do Estoque (Custo)</p>
            <p class="text-xl font-bold text-gray-900">R$ {{ number_format($valorTotalEstoque, 2, ',', '.')}}</p>
        </div>

        <div class="card bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
            <p class="text-sm font-medium text-gray-500">Total de Itens Críticos</p>
            {{-- Calcula o total de produtos que estão abaixo ou igual ao estoque mínimo --}}
            <p class="text-3xl font-bold text-yellow-600">{{ $estoqueCritico->count() }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-red-700 border-b pb-2">Itens Abaixo do Estoque Mínimo</h3>
            @if ($estoqueCritico->isEmpty())
                <p class="text-gray-500">Nenhum alerta de estoque. Tudo sob controle!</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach ($estoqueCritico->take(5) as $produto)
                        <li class="py-3 flex justify-between itens-center text-sm">
                            <span class="font-medium text-gray-900">{{ $produto->nome }}</span>
                            <span class="text-red-600 font-bold">
                                {{ $produto->quant_estoque }} / Min: {{ $produto->estoque_min}}
                            </span>
                        </li>
                    @endforeach
                    @if ($estoqueCritico->count() > 5)
                    <li class="pt-3 text-center text-sm">
                        <a href="{{ route('produtos.index') }}" class="text-indigo-600 hover:underline"> Ver todos os {{ $estoqueCritico->count() }} alertas</a>       
                    </li>
                    @endif    
                </ul>
            @endif        
        </div>
    
        <div class="bg-white p-6 rounded-lg shado-md">
            <h3 class="text-xl font-semibold mb-4 text-yellow-700 border-b pb-2">Produtos com Vencimento próximo</h3>
            @if ($vencimentoProximo->isEmpty())
                <p class="text-gray-500">Nenhum produto vencendo em breve.</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach ($vencimentoProximo->take(5) as $produto)
                        <li class="py-3 flex justify-between itens-center text-sm">
                            <span class="font-medium text-gray-900">{{ $produto->nome}}</span>
                            @php
                                $validade = \Carbon\Carbon::parse($produto->data_validade)->startOfDay();
                                $hoje = \Carbon\Carbon::now()->startOfDay();
                                $diasStatus = $hoje->diffInDays($validade, false); 
                                $diasAbsolutos = abs($diasStatus); 
                                $dataVencimento = $validade->format('d/m/Y');
                            @endphp
                            @if ($diasStatus < 0) 
                                <span class="text-red-600 font-bold">EXPIRADO HÁ {{ $diasAbsolutos }} DIAS ({{ $dataVencimento}})</span>
                            @elseif ($diasStatus === 0)
                                <span class="text-red-600 font-bold">VENCE HOJE ({{ $dataVencimento}})</span>
                            @else
                                <span class="text-yellow-600">Vence em {{ $diasAbsolutos}} dias ({{ $dataVencimento}})</span>
                            @endif
                        </li>
                    @endforeach
                    <li class="pt-3 text-center text-sm">
                        <a href="{{ route('produtos.index') }}" class="text-indigo-600 hover:underline">Ver todos</a>
                    </li>
                </ul>
            @endif 
        </div>
    </div>
</div>
@endsection
