<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('preco_venda', 10, 2);
            $table->decimal('preco_custo', 10, 2);
            $table->integer('quant_estoque')->default(0);
            $table->integer('estoque_min')->default(10);
            $table->date('data_validade')->nullable();
            $table->timestamps();

            $table->foreignId('categoria_id')
                ->constrained()
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
