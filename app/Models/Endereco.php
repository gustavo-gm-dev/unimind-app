<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'enderecos';

    // Nome da chave primária
    protected $primaryKey = 'endereco_id';

    // Tipos de dados que podem ser preenchidos em massa
    protected $fillable = [
        'endereco_cliente_id',
        'endereco_logradouro',
        'endereco_numero',
        'endereco_complemento',
        'endereco_bairro',
        'endereco_cidade',
        'endereco_uf',
        'endereco_cep',
        'endereco_pais',
    ];

    // Relacionamento

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'endereco_cliente_id','cliente_id');
    }
}