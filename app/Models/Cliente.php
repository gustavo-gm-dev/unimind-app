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
        'cliente_usuario_id',
        'cliente_usuario_id_atualizado',
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
        'cliente_st_cadastro',
    ];

    // Relacionamentos
    public function endereco()
    {
        return $this->hasMany(Endereco::class, 'endereco_cliente_id', 'cliente_id');
    }


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

    /**
     * Scope para filtrar clientes vinculados ao aluno autenticado
     */
    public function scopeByAluno($query, $user)
    {
        if ($user->isAluno()) {
            return $query->whereHas('vinculos', function ($q) use ($user) {
                $q->where('vinculo_aluno_id', $user->id);
            });
        }

        return $query; // Sem restrição se não for aluno
    }

    /**
     * Relacionamento com vínculos
     */
    public function vinculos()
    {
        return $this->hasMany(Vinculo::class, 'vinculo_cliente_id', 'cliente_id');
    }
}
