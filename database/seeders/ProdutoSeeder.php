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

        Produto::create([
            'nome' => 'Semente de Milho Híbrido (10kg)',
            'descricao' => 'Alto potencial de produtividade. Pacote de 10kg.',
            'preco_venda' => 320.00,
            'preco_custo' => 250.00,
            'categoria_id' => $sementeId,
            'quant_estoque' => 15,       
            'estoque_min' => 5,
            'data_validade' => now()->addDays(20), // Vence em menos de 30 dias (Alerta de validade)
        ]);

        Produto::create([
            'nome' => 'Vacina Antirrábica 1 dose',
            'descricao' => 'Vacina obrigatória para cães e gatos. Armazenar refrigerado.',
            'preco_venda' => 35.00,
            'preco_custo' => 15.00,
            'categoria_id' => $medicamentoId,
            'quant_estoque' => 0,        // << ESTOQUE ZERO (Em Falta)
            'estoque_min' => 20,
            'data_validade' => now()->addMonths(18),
        ]);

        Produto::create([
            'nome' => 'Ração para Aves Postura (5kg)',
            'descricao' => 'Ração completa para galinhas poedeiras.',
            'preco_venda' => 25.00,
            'preco_custo' => 12.00,
            'categoria_id' => $racaoId,
            'quant_estoque' => 150,      // << Estoque alto
            'estoque_min' => 30,
            'data_validade' => now()->addMonths(5),
        ]);

        Produto::create([
            'nome' => 'Bebedouro Automático 5 Litros',
            'descricao' => 'Bebedouro por gravidade, ideal para pequenos animais.',
            'preco_venda' => 65.00,
            'preco_custo' => 35.00,
            'categoria_id' => $ferramentaId,
            'quant_estoque' => 10,        
            'estoque_min' => 10,           // << Estoque Mínimo Exato (Atenção)
            'data_validade' => null,
        ]);

        Produto::create([
            'nome' => 'Fertilizante NPK 10-10-10 (25kg)',
            'descricao' => 'Adubo balanceado para uso geral em hortaliças e jardins.',
            'preco_venda' => 199.90,
            'preco_custo' => 120.00,
            'categoria_id' => $sementeId, 
            'quant_estoque' => 50,
            'estoque_min' => 15,
            'data_validade' => now()->addYears(2), // Validade Longa
        ]);

        Produto::create([
            'nome' => 'Antibiótico Injetável para Bovinos',
            'descricao' => 'Frasco de 50ml. Uso em casos de infecções sistêmicas.',
            'preco_venda' => 180.00,
            'preco_custo' => 95.00,
            'categoria_id' => $medicamentoId, 
            'quant_estoque' => 3,          // << Estoque Baixo Crítico
            'estoque_min' => 5,
            'data_validade' => now()->addDays(5), // << Vencimento Imediato (Máximo Alerta)
        ]);

        Produto::create([
            'nome' => 'Tesoura de Poda Profissional',
            'descricao' => 'Lâmina de aço temperado, cabo emborrachado.',
            'preco_venda' => 75.00,
            'preco_custo' => 38.00,
            'categoria_id' => $ferramentaId, 
            'quant_estoque' => 10,
            'estoque_min' => 10,             // << Testa o limite exato
            'data_validade' => null, 
        ]);

        Produto::create([
            'nome' => 'Ração para Peixes de Lago',
            'descricao' => 'Flutuante, pacote de 1kg.',
            'preco_venda' => 45.00,
            'preco_custo' => 25.00,
            'categoria_id' => $racaoId, 
            'quant_estoque' => 0,          // << ESTOQUE ZERO (Em Falta)
            'estoque_min' => 20,
            'data_validade' => now()->addMonths(4), 
        ]);
        
    }
}
