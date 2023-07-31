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
        Schema::create('form', function (Blueprint $table) {
            $table->integer('id_user')->primary()->unique();
            $table->string('pessoa');
            $table->string('nomeArtistico');
            $table->string('nomeCompleto');
            $table->string('dataNascimento');
            $table->string('nomeMae')->nullable();
            $table->string('razaoSocial')->nullable();
            $table->string('pis')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('rg');
            $table->string('cpf');
            $table->string('orgaoExpedidor');
            $table->string('email');
            $table->string('celular');
            $table->string('responsavel')->nullable();
            $table->string('celResponsavel')->nullable();
            $table->string('cep');
            $table->string('cidade');
            $table->string('rua');
            $table->string('bairro');
            $table->string('numCasa');
            $table->string('complemento')->nullable();
            $table->string('banco');
            $table->string('agencia');
            $table->string('contaCorrente');
            $table->string('produtorCultural')->nullable();
            $table->string('produtorEsportivo')->nullable();
            $table->string('artista')->nullable();
            $table->string('atleta')->nullable();
            $table->string('tipo')->nullable();
            $table->string('aguardando')->nullable();
            $table->text('motivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form');
    }
};
