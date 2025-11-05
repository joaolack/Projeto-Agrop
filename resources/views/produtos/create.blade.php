@extends('layouts.app')

@section('slot')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white dark:bg-gray-800">
                <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 mb-6"> 
                    Cadastrar Novo Produto
                </h1>
                    <form action="{{ route('produtos.store') }}" methos="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                Nome do Produto: <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="nome" name="nome" class="form-input mt-1 block w-full rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="categoria_id" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                Categoria: <span class="text-red-600">*</span>
                            </label>
                            <select id="categoria_id" name="categoria_id" required class="form-select rounded" >
                                <option value="">Selecione uma categoria</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach    
                            </select>
                        </div>
                        

                    </form>               
            </div>
        </div>
    </div>    
</div>


@endsection