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
    Schema::create('autenticacao', function (Blueprint $table) {
        $table->id();
        $table->decimal('valor',10,2)->default(0.00);
        $table->dateTime('data_autenticacao')->nullable();
        $table->integer('numero_cheque')->nullable();
        $table->string('agencia', length: 6)->nullable();
        $table->string('conta', length: 15)->nullable();
        $table->string('banco', length: 30)->nullable();
        $table->foreignId('id_usuario')->constrained('users');
        $table->foreignId('id_protocolo')->constrained('protocolo');
        $table->foreignId('id_forma_pagamento')->constrained('forma_pagamento');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
