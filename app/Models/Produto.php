<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{


    protected $table = 'produtos';
    protected $fillable = [
        'nome', 
        'descricao',
        'preco_venda', 
        'preco_custo', 
        'categoria_id', 
        'quant_estoque', 
        'estoque_min',
        'data_validade',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function getEstoqueStatusAttribute() // Acessor Laravel para status do estoque
    {
        if ($this->quant_estoque <= 0) {
            return 'Em Falta';
        }
        if ($this->quant_estoque <= $this->estoque_min) {
            return 'Estoque Baixo';
        }
        return 'Estoque Normal';
    }
   
}
