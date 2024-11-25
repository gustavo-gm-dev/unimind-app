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
        'vinculo_usuario_id', // ID do professor que criou o vínculo
        'vinculo_aluno_id',   // ID do aluno vinculado
        'vinculo_cliente_id', // ID do cliente vinculado
        'vinculo_data_inicio',
        'vinculo_data_fim',
    ];

    /**
     * Relacionamento com o modelo User (professor)
     */
    public function professor()
    {
        return $this->belongsTo(User::class, 'vinculo_usuario_id', 'id');
    }

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

    /**
     * Verifica se o vínculo está ativo com base na data atual
     *
     * @return bool
     */
    public function isAtivo()
    {
        $hoje = now()->toDateString(); // Apenas a data atual
        $dataInicio = $this->vinculo_data_inicio->toDateString();
        $dataFim = $this->vinculo_data_fim->toDateString();

        return $dataInicio <= $hoje && $dataFim >= $hoje;
    }

}
