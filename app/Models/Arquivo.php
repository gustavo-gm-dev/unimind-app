<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    protected $table = 'arquivos';

    protected $fillable = [
        'arquivo_prontuario_id',
        'arquivo_url',
        'arquivo_dt_realizada',
    ];

    public function prontuario()
    {
        return $this->belongsTo(Prontuario::class, 'arquivo_prontuario_id', 'prontuario_id');
    }
}

