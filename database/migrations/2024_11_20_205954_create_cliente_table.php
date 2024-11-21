<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('cliente_Id');
            $table->string('cliente_nome',length : 255);
            $table->string('cliente_cpf',length : 14);
            $table->string('cliente_rg',length : 15);
            $table->string('cliente_email',length : 255);
            $table->decimal('cliente_DDD', 2);
            $table->decimal('cliente_telefone', 9);
            $table->timestamps();
            $table->date('cliente_dt_nascimento');
            $table->string('cliente_id_escolaridade',length : 255);
            $table->string('cliente_genero',length : 1);
            $table->string('cliente_periodo_preferencia',length : 1);
            $table->time('cliente_horario_preferencia');
            $table->decimal('cliente_necessidade_Id',1,0);
            $table->decimal('cliente_st_confirma_dados', 1,0);
        });

        Schema::create('cliente_necessidade', function (Blueprint $table) {
            $table->id('cliente_necessidade_id');
            $table->integer('cliente_necessidade_necessidade_id');
            $table->integer('cliente_necessidade_cliente_id');
            $table->timestamps();
        });
        Schema::create('necessidade', function (Blueprint $table) {
            $table->id('necessidade_id');
            $table->integer('necessidade_nome');
        });

        Schema::create('contato', function (Blueprint $table) {
            $table->id('contato_Id');
            $table->integer('contato_cliente_id');
            $table->string('contato_nome',length : 150);
            $table->string('contato_telefone',length : 150);
            $table->string('contato_situacao',length : 1);
            $table->string('contato_Emergencia',length : 1);
            $table->timestamps();
        });

        Schema::create('endereco', function (Blueprint $table) {
            $table->id('endereco_id');
            $table->integer('endereco_cliente_id');
            $table->string('endereco_logradouro',length : 255);
            $table->integer('endereco_numero');
            $table->string('endereco_complemento',length : 255);
            $table->string('endereco_bairro',length : 100);
            $table->string('endereco_cidade',length : 100);
            $table->string('endereco_uf',length : 2);
            $table->string('endereco_cep',length : 8);
            $table->string('endereco_pais',length : 25);
            $table->timestamps();
        });

        Schema::create('usuario_cliente', function (Blueprint $table) {
            $table->id('usuario_cliente_Id');
            $table->integer('usuario_cliente_usuario_id');
            $table->integer('usuario_cliente_cliente_id');
            $table->dateTime('usuario_cliente_dt_expiracao');
            $table->timestamps();
        });

        Schema::create('prontuario', function (Blueprint $table) {
            $table->id('prontuario_id');
            $table->integer('prontuario_cliente_id');
            $table->string('prontuario_tx_historico_familiar');
            $table->string('prontuario_tx_historico_social');
            $table->string('prontuario_tx_consideracoes');
            $table->string('prontuario_tx_observacao');
            $table->integer('prontuario_st_validacao_prof')->default('0');
            $table->timestamps();
        });

        Schema::create('cliente_arquivo', function (Blueprint $table) {
            $table->id('cliente_arquivo_id');
            $table->integer('cliente_arquivo_cliente_id');
            $table->integer('cliente_arquivo_arquivo_id');
            $table->timestamps();
        });

        Schema::create('arquivos', function (Blueprint $table) {
            $table->id('arquivos_id');
            $table->string('arquivos_url');
            $table->integer('cliente_arquivo_arquivo_id');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
        Schema::dropIfExists('cliente_necessidade');
        Schema::dropIfExists('necessidade');
        Schema::dropIfExists('contato');
        Schema::dropIfExists('usuario_cliente');
        Schema::dropIfExists('prontuario');
        Schema::dropIfExists('cliente_arquivo');
        Schema::dropIfExists('arquivos');
    }
};
