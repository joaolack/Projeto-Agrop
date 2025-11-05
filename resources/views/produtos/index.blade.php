@extends('layouts.app')
    
@section('slot')
<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800">
                <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-200
                mb-10">
                    Lista de Produtos
                </h1>

                <a href="{{ route('produtos.create') }}" class="bg-green-600 hover:bg-[#015724] text-white font-bold py-2 px-4 rounded mb-4 inline-block transition duration-200">
                    + Novo Produto
                </a>

                <div class="overflow-x-auto mt-6 rounded">
                    <table class="w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700 border-x border-gray-100 dark:border-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Produto
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Estoque Atual
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Preço Venda
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Categoria
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Descrição
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider text-center">
                                    Validade
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider text-center">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-600 border border-gray-300 dark:border-gray-600 rounded">
                            @forelse ($produtos as $produto)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $produto->nome }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                    <span class="font-semibold {{ $produto->quant_estoque <= 5 ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $produto->quant_estoque }}
                                    </span>
                                    <small class="text-gray-500 block">Min: {{ $produto->estoque_min }}</small>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @php
                                        $status = $produto->estoque_status;
                                        $class = '';
                                        if ($status == 'Em Falta') $class = 'bg-red-100 text-red-800';
                                        else if ($status == 'Estoque Baixo') $class = 'bg-yellow-100 text-yellow-800';
                                        else $class = 'bg-green-100 text-green-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $class }}">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $produto->categoria->nome ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $produto->descricao }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 text-center">
                                    @if ($produto->data_validade)
                                        @if (\Carbon\Carbon::parse($produto->data_validade)->isPast())
                                            <span class="text-red-500 font-bold">EXPIRADO!</span>
                                    @elseif (\Carbon\Carbon::parse($produto->data_validade)->lessThan(now()->addDays(30)))
                                            <span class="text-yellow-600">Vence em {{ \Carbon\Carbon::parse($produto->data_validade)->diffInDays(now()) }} dias</span>
                                    @else
                                            {{ \Carbon\Carbon::parse($produto->data_validade)->format('d/m/Y') }}
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('produtos.edit', $produto) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3 transition duration-150">
                                        Editar
                                    </a>
                            
                                    <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition duration-150">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty 
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $produtos->links()}}
                </div>
            </div>    
        </div>
    </div>
</div>
@endsection