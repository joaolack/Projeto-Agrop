<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    
    public function run(): void
    {
        Categoria::create(['nome' => 'Rações e Alimentos', 'descricao' => 'Produtos para nutrição animal.']);
        Categoria::create(['nome' => 'Medicamentos Veterinários', 'descricao' => 'Vacinas, vermífugos e tratamentos.']);
        Categoria::create(['nome' => 'Ferramentas e Equipamentos', 'descricao' => 'Itens para manejo e manutenção.']);
        Categoria::create(['nome' => 'Sementes e Fertilizantes', 'descricao' => 'Produtos para cultivo e agricultura.']);
    }
}
