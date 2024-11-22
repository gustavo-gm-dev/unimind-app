<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('cliente_id');
            $table->string('cliente_nome', 255);
            $table->string('cliente_cpf', 14);
            $table->string('cliente_rg', 15);
            $table->string('cliente_email', 255);
            $table->string('cliente_ddd', 2);
            $table->string('cliente_telefone', 15);
            $table->date('cliente_dt_nascimento');
            $table->string('cliente_escolaridade', 50);
            $table->string('cliente_genero', 1);
            $table->string('cliente_periodo_preferencia', 20);
            $table->boolean('cliente_st_confirma_dados')->default(false);
            $table->enum('cliente_tipo_atendimento', ['Presencial', 'Remoto'])->default('Presencial');
            $table->timestamps();
        });

        Schema::create('necessidades', function (Blueprint $table) {
            $table->id('necessidade_id');
            $table->string('necessidade_nome', 255);
            $table->timestamps();
        });

        Schema::create('cliente_necessidades', function (Blueprint $table) {
            $table->id('cliente_necessidade_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('necessidade_id');
            $table->timestamps();

            $table->foreign('cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
            $table->foreign('necessidade_id')->references('necessidade_id')->on('necessidades')->onDelete('cascade');
        });

        Schema::create('contatos', function (Blueprint $table) {
            $table->id('contato_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('contato_nome', 150);
            $table->string('contato_telefone', 150);
            $table->string('contato_situacao', 1);
            $table->string('contato_emergencia', 1);
            $table->timestamps();

            $table->foreign('cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
        });

        Schema::create('enderecos', function (Blueprint $table) {
            $table->id('endereco_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('endereco_logradouro', 255);
            $table->integer('endereco_numero');
            $table->string('endereco_complemento', 255)->nullable();
            $table->string('endereco_bairro', 100);
            $table->string('endereco_cidade', 100);
            $table->string('endereco_uf', 2);
            $table->string('endereco_cep', 8);
            $table->string('endereco_pais', 25);
            $table->timestamps();

            $table->foreign('cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
        });

        Schema::create('prontuarios', function (Blueprint $table) {
            $table->id('prontuario_id');
            $table->unsignedBigInteger('prontuario_cliente_id'); // Chave estrangeira para cliente
            $table->text('prontuario_tx_historico_familiar');
            $table->text('prontuario_tx_historico_social');
            $table->text('prontuario_tx_consideracoes');
            $table->text('prontuario_tx_observacao');
            $table->boolean('prontuario_st_validacao_prof')->default(false);
            $table->timestamps();
        
            // Definindo a chave estrangeira
            $table->foreign('prontuario_cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
        });
        

        Schema::create('arquivos', function (Blueprint $table) {
            $table->id('arquivo_id');
            $table->unsignedBigInteger('prontuario_id');
            $table->string('arquivo_url');
            $table->date('arquivo_dt_realizada');
            $table->timestamps(); 
        
            // Chave estrangeira para vincular ao prontuario
            $table->foreign('prontuario_id')->references('prontuario_id')->on('prontuarios')->onDelete('cascade');
        });
        

        Schema::create('sessoes', function (Blueprint $table) {
            $table->id('sessao_id');
            $table->unsignedBigInteger('sessao_prontuario_id'); // Chave estrangeira para prontuários
            $table->dateTime('sessao_dt_inicio');
            $table->dateTime('sessao_dt_fim');
            $table->text('sessao_tx_principal')->nullable();
            $table->text('sessao_tx_procedimento')->nullable();
            $table->text('sessao_tx_encaminhamento')->nullable();
            $table->text('sessao_tx_observacao')->nullable();
            $table->enum('sessao_tipo_atendimento', ['Presencial', 'Remoto'])->default('Presencial');
            $table->boolean('sessao_st_presenca')->default(false);
            $table->boolean('sessao_st_confirmado')->default(false);
            $table->timestamps();
        
            // Definindo a chave estrangeira
            $table->foreign('sessao_prontuario_id')->references('prontuario_id')->on('prontuarios')->onDelete('cascade');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('sessoes');
        Schema::dropIfExists('prontuario_arquivos');
        Schema::dropIfExists('arquivos');
        Schema::dropIfExists('prontuarios');
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('contatos');
        Schema::dropIfExists('cliente_necessidades');
        Schema::dropIfExists('necessidades');
        Schema::dropIfExists('clientes');
    }
};
