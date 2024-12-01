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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna professor_id que referencia a própria tabela users
            $table->unsignedBigInteger('professor_id')->nullable()->after('id');
            $table->foreign('professor_id')->references('id')->on('users')->onDelete('set null');

            // Adiciona a coluna ativo
            $table->boolean('ativo')->default(true)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove as colunas professor_id e ativo
            $table->dropForeign(['professor_id']);
            $table->dropColumn('professor_id');
            $table->dropColumn('ativo');
        });
    }
};
