<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prontuario extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'prontuarios';

    // Nome da chave primária
    protected $primaryKey = 'prontuario_id';

    protected $dates = ['created_at', 'updated_at'];

    // Tipos de dados que podem ser preenchidos em massa
    protected $fillable = [
        'prontuario_cliente_id',
        'prontuario_usuario_id_atualizado',
        'prontuario_tx_historico_familiar',
        'prontuario_tx_historico_social',
        'prontuario_tx_consideracoes',
        'prontuario_tx_observacao',
        'prontuario_st_validacao_prof',
    ];

    // Relacionamentos
    public function sessoes()
    {
        return $this->hasMany(Sessao::class, 'sessao_prontuario_id', 'prontuario_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'prontuario_cliente_id', 'cliente_id');
    }

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class, 'arquivo_prontuario_id');
    }

    public function ultimoArquivo()
    {
        return $this->hasOne(Arquivo::class, 'arquivo_prontuario_id', 'prontuario_id')->orderBy('arquivo_dt_realizada', 'desc');
    }
}
