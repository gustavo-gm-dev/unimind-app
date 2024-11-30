<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'vinculos';

    // Tipos de dados que podem ser preenchidos em massa
    protected $fillable = [
        'vinculo_aluno_id',
        'vinculo_cliente_id',
    ];

    /**
     * Relacionamento com o modelo User (aluno)
     */
    public function aluno()
    {
        return $this->belongsTo(User::class, 'vinculo_aluno_id', 'id');
    }

    /**
     * Relacionamento com o modelo Cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'vinculo_cliente_id', 'cliente_id');
    }

}
