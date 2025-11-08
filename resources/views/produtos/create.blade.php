@extends('layouts.app')

@section('slot')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white dark:bg-gray-800">
                <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 mb-6"> 
                    Cadastrar Novo Produto
                </h1>

                @if ($errors->any())
                    <div class="alert-error mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('produtos.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nome" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Nome do Produto: <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" class="form-input mt-1 block w-full rounded @error('nome') border-red-500 @enderror" required>
                        @error('nome') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="categoria_id" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Categoria: <span class="text-red-600">*</span>
                        </label>
                        <select id="categoria_id" name="categoria_id" required class="form-select @error('categoria_id') border-red-500 @enderror rounded" >
                            <option value="">Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach    
                        </select>
                        @error('categoria_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="preco_custo" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Preço de Custo (R$) <span class="text-red-600">*</span>
                        </label>
                        <input type="number" step="0.01" min="0" id="preco_custo" value="{{ old('preco_custo') }}" name="preco_custo" class="form-input mt-1 block w-full @error('preco_custo') border-red-500 @enderror rounded" required></input>
                        @error('preco_custo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="preco_venda" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Preço de Venda (R$) <span class="text-red-600">*</span>
                        </label>
                        <input type="number" step="0.01" min="0.01" id="preco_venda" name="preco_venda" value="{{ old('preco_venda') }}" class="form-input mt-1 block w-full @error('preco_venda') border-red-500 @enderror rounded" required></input>
                        @error('preco_venda') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="quant_estoque" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Quantidade em Estoque: <span class="text-red-600">*</span>
                        </label>
                        <input type="number" min="0" id="quant_estoque" name="quant_estoque" value="{{ old('quant_estoque', 0) }}" class="form-input mt-1 block w-full @error('quant_estoque') border-red-500 @enderror rounded" required></input>
                        @error('quant_estoque') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="estoque_min" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Estoque Mínimo: <span class="text-red-600">*</span>
                        </label>
                        <input type="number" min="0" id="estoque_min" name="estoque_min" class="form-input mt-1 block w-full @error('estoque_min') border-red-500 @enderror rounded" required></input>
                        @error('estoque_min') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="data_validade" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Data de Validade: <span class="text-red-600">*</span>
                        </label>
                        <input type="date" id="data_validade" name="data_validade" value="{{ old('data_validade') }}" class="form-input mt-1 block w-full @error('data_validade') border-red-500 @enderror rounded" required></input>
                        @error('data_validade') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="descricao" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            Descrição do Produto: <span class="text-red-600">*</span>
                        </label>
                        <textarea id="descricao" name="descricao" rows="3" class="form-textarea mt-1 block w-full  @error('descricao') border-red-500 @enderror rounded" required></textarea>
                        @error('descricao') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="btn-primary-large">
                            Cadastrar Produto
                        </button>
                    </div>        
                </form>               
            </div>
        </div>
    </div>    
</div>


@endsection