<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'sessoes';

    // Nome da chave primária
    protected $primaryKey = 'sessao_id';

    // Tipos de dados que podem ser preenchidos em massa
    protected $fillable = [
        'sessao_prontuario_id',
        'sessao_dt_inicio',
        'sessao_dt_fim',
        'sessao_tx_principal',
        'sessao_tx_procedimento',
        'sessao_tx_encaminhamento',
        'sessao_tx_observacao',
        'sessao_tipo_atendimento',
        'sessao_st_presenca',
        'sessao_st_confirmado',
    ];

    // Relacionamentos
    public function prontuario()
    {
        return $this->belongsTo(Prontuario::class, 'sessao_prontuario_id', 'prontuario_id');
    }

    protected $casts = [
        'sessao_dt_inicio' => 'datetime', // Certifique-se de ajustar para o nome correto do campo
    ];
}
