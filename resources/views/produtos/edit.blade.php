@extends('layouts.app')

@section('slot')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800">
                <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Editar Produto: {{ $produto->nome }}</h1>
                <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nome" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Nome do Produto: <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome', $produto->nome) }}" class="form-input mt-1 block w-full rounded-lg border-gray-500 shadow-md focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                        @error('nome') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="categoria_id" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Categoria: <span class="text-red-600">*</span>
                        </label>
                        <select id="categoria_id" name="categoria_id" class="form-input mt-1 block rounded-lg border-gray-500 shadow-md focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                            <option value="">Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">
                                    {{ old('categoria_id', $produto->categoria_id) == $categoria->id ? 'atual' : ''}}
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="preco_custo" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Preço de Custo (R$) <span class="text-red-600">*</span>
                        </label>
                        <input type="number" step="0.01" min="0" id="preco_custo" name="preco_custo" value="{{ old('preco_custo', $produto->preco_custo) }}" class="form-input mt-1 block w-full rounded-lg border-gray-500 shadow-md focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                        @error('preco_custo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror    
                    </div>
                    <div class="mb-4">
                        <label for="preco_venda" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Preço de Venda (R$) <span class="text-red-600">*</span>
                        </label>
                        <input type="number" step="0.01" min="0.01" id="preco_venda" name="preco_venda" value="{{ old('preco_venda', $produto->preco_venda) }}" class="form-input mt-1 block w-full rounded-lg border-gray-500 shadow-md focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                        @error('preco_venda') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="estoque_min" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Estoque Mínimo: <span class="text-red-600">*</span>
                        </label>
                        <input type="number" min="0" id="estoque_min" name="estoque_min" value="{{ old('estoque_min', $produto->estoque_min) }}" class="form-input mt-1 block w-full rounded-lg border-gray-500 shadow-md focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                        @error('estoque_min') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="data_validade" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Data de Validade: <span class="text-red-600">*</span>
                        </label>
                        <input type="date" id="data_validade" name="data_validade" value="{{ old('data_validade', $produto->data_validade ? $produto->data_validade->format('Y-m-d') : '') }}" class="form-input mt-1 block w-full rounded-lg border-gray-500 shadow-md focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                        @error('data_validade') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror  
                    </div>
                    <div class="mb-4">
                        <label for="descricao" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Descrição: <span class="text-red-600">*</span>
                        </label>
                        <textarea id="descricao" name="descricao" rows="3" class="form-input mt-1 block w-full rounded-lg border-gray-500 shadow-md focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">{{ old('descricao', $produto->descricao) }}</textarea>
                        @error('descricao') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-green-600 hover:bg-[#015724] text-white font-bold py-3 px-4 rounded transition duration-200 inline-block">
                            Salvar Alterações
                        </button>
                        <a href="{{ route('produtos.index') }}" class="bg-red-600 hover:bg-[#7A0C0C] text-white font-bold py-3 px-4 rounded transition duration-200 inline-block">
                            Cancelar  
                        </a>
                    </div>
                </form>

                <hr class="my-8">

                <h2 class="text-2xl font-semibold mb-4">📦 Movimentação de Estoque</h2>
                <p class="mb-2">Estoque Atual: **{{ $produto->quant_estoque }}**</p>
                <p class="mb-4 text-sm text-gray-500">Estoque Mínimo: **{{ $produto->estoque_min }}**</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 border border-green-300 rounded-lg bg-green-50">
                        <h3 class="text-xl font-medium text-green-700 mb-4">Entrada (Adicionar)</h3>
                        <form action="{{ route('produtos.moveEstoque', $produto->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="operacao" value="entrada">
                            <div class="mb-4">
                                <label for="quant_entrada" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Quantidade a Adicionar: <span class="text-red-600">*</span>
                                </label>
                                <input type="number" min="1" id="quant_entrada" name="quantidade" value="{{ old('quantidade') }}" required class="w-full">
                                @if (session('operacao') == 'entrada') 
                                    @error('quantidade') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                @endif    
                            </div>
                            <button type="submit" class="bg-green-600 hover:bg-[#015724] text-white font-bold py-2 px-4 rounded transition duration-200">
                                Registrar Entrada
                            </button>
                        </form> 
                    </div>
                    <div class="p-6 border border-red-300 rounded-lg bg-red-50">
                        <h3 class="text-xl font-medium text-red-700 mb-4">Saída (Remover)</h3>
                        <form action="{{ route('produtos.moveEstoque', $produto->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="operacao" value="saida">
                            <div class="mb-4">
                                <label for="quant_saida" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Quantidade a Remover: <span class="text-red-600">*</span>
                                </label>
                                <input type="number" min="1" id="quant_saida" name="quantidade" value="{{ old('quantidade') }}" required class="w-full">
                                @if (session('operacao') == 'saida')
                                    @error('quantidade') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                @endif    
                            </div>
                            <button type="submit" class="bg-red-600 hover:bg-[#7A0C0C] text-white font-bold py-2 px-4 rounded transition duration-200">
                                Registrar Saída
                            </button>    
                        </form>
                    </div>




            </div>
        </div>
    </div>        
</div>    
@endsection