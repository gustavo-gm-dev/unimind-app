<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'clientes';

    // Nome da chave primária
    protected $primaryKey = 'cliente_id';

    // Tipos de dados que podem ser preenchidos em massa
    protected $fillable = [
        'cliente_nome',
        'cliente_cpf',
        'cliente_rg',
        'cliente_email',
        'cliente_ddd',
        'cliente_telefone',
        'cliente_dt_nascimento',
        'cliente_escolaridade',
        'cliente_genero',
        'cliente_periodo_preferencia',
        'cliente_necessidade_id',
        'cliente_tipo_atendimento',
        'cliente_st_confirma_dados',
    ];

    // Relacionamentos

    public function prontuario()
    {
        return $this->hasOne(Prontuario::class, 'prontuario_cliente_id', 'cliente_id');
    }

    public function sessoes()
    {
        return $this->hasManyThrough(
            Sessao::class,
            Prontuario::class,
            'prontuario_cliente_id', // Chave estrangeira em Prontuario
            'sessao_prontuario_id',  // Chave estrangeira em Sessao
            'cliente_id',            // Chave local em Cliente
            'prontuario_id'          // Chave local em Prontuario
        );
    }
}
