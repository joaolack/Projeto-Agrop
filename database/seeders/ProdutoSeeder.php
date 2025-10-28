<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoSeeder extends Seeder
{
   
    public function run(): void
    {
        // Buscar o ID das categorias para facilitar a associação
        $racaoId = Categoria::where('nome', 'Rações e Alimentos')->first()->id;
        $medicamentoId = Categoria::where('nome', 'Medicamentos Veterinários')->first()->id;
        $ferramentaId = Categoria::where('nome', 'Ferramentas e Equipamentos')->first()->id;
        $sementeId = Categoria::where('nome', 'Sementes e Fertilizantes')->first()->id;

        Produto::create([
            'nome' => 'Ração Premium para Cães (15kg)',
            'descricao' => 'Alimento completo e balanceado para cães adultos.',
            'preco_venda' => 150.00,
            'preco_custo' => 85.00,
            'categoria_id' => $racaoId,
            'quant_estoque' => 5,        // << ESTOQUE BAIXO (para testar o alerta)
            'estoque_min' => 10,
            'data_validade' => now()->addMonths(6),
        ]);

        Produto::create([
            'nome' => 'Vermífugo de Amplo Espectro',
            'descricao' => 'Caixa com 4 comprimidos. Uso veterinário.',
            'preco_venda' => 45.90,
            'preco_custo' => 20.00,
            'categoria_id' => $medicamentoId,
            'quant_estoque' => 30,       // << ESTOQUE NORMAL
            'estoque_min' => 5,
            'data_validade' => now()->addMonths(2),
        ]);

        Produto::create([
            'nome' => 'Pá Agrícola Reforçada',
            'descricao' => 'Cabo de madeira e lâmina em aço carbono.',
            'preco_venda' => 89.90,
            'preco_custo' => 45.00,
            'categoria_id' => $ferramentaId,
            'quant_estoque' => 2,        // << ESTOQUE EM FALTA (para testar o alerta)
            'estoque_min' => 5,
            'data_validade' => null, // Ferramentas não têm validade
        ]);

        Produto::create([
            'nome' => 'Fertilizante Orgânico (20kg)',
            'descricao' => 'Melhora a qualidade do solo e aumenta a produtividade.',
            'preco_venda' => 120.00,
            'preco_custo' => 70.00,
            'categoria_id' => $sementeId,
            'quant_estoque' => 0,        // << ESTOQUE EM FALTA (para testar o alerta)
            'estoque_min' => 10,
            'data_validade' => now()->addMonths(12),
        ]);
    }
}
