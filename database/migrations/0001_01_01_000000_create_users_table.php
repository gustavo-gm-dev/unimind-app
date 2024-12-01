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

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });


/*
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('usuario_Id');
            $table->string('usuario_name');
            $table->string('usuario_Sobrenome');
            $table->string('usuario_email')->unique();
            $table->timestamp('usuario_Email_Verificado')->nullable();
            $table->string('usuario_Senha');
            $table->integer('usuario_professor_id')->index();
            $table->datetime('usuario_dt_cadastro');
            $table->datetime('usuario_dt_atualizacao');
            $table->char('usuario_ativo',1)->default('S');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('acesso', function (Blueprint $table) {
            $table->id('acesso_id');
            $table->string('acesso_situacao',1);
            $table->timestamps();
        });
        Schema::create('dominio', function (Blueprint $table) {
            $table->id('dominio_id');
            $table->integer('dominio_acesso_id');
            $table->string('dominio_nome');
            $table->string('dominio_link');
        });
        Schema::create('acesso_perfil', function (Blueprint $table) {
            $table->id('acesso_perfil_id');
            $table->integer('acesso_perfil_perfil_id');
            $table->integer('acesso_perfil_acesso_id');
        });
        Schema::create('perfil', function (Blueprint $table) {
            $table->id('perfil_id');
            $table->string('perfil_nome');
            $table->string('perfil_descricao');
            $table->timestamps();
        });
        Schema::create('regras_perfil', function (Blueprint $table) {
            $table->id('regras_perfil_id');
            $table->integer('regras_perfil_regra_id');
            $table->integer('regras_perfil_perfil_id');
        });
        Schema::create('regras', function (Blueprint $table) {
            $table->id('regras_id');
            $table->string('regras_nome');
            $table->string('regras_descricao');
            $table->timestamps();
        });
*/

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        /*
        Schema::dropIfExists('usuario');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('acesso');
        Schema::dropIfExists('dominio');
        Schema::dropIfExists('acesso_perfil');
        Schema::dropIfExists('perfil');
        Schema::dropIfExists('regras_perfil');
        Schema::dropIfExists('regras');
        */
    }
};
