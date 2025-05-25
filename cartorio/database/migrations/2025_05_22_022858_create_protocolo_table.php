<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('protocolo', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_documento');
            $table->date('data_documento');
            $table->date('data_abertura')->default(DB::raw('CURRENT_DATE'));
            $table->date('data_cancelamento')->nullable();
            $table->integer('numero_protocolo');
            $table->integer('numero_registro');
            $table->dateTime('data_retirada');
            $table->dateTime('data_registro');

            // Relacionamentos
            $table->foreignId('id_usuario')->constrained('usuario');
            $table->foreignId('id_apresentante')->constrained('apresentante');
            $table->foreignId('id_grupo')->constrained('grupo');
            $table->foreignId('id_especie')->constrained('especie');
            $table->foreignId('id_natureza')->constrained('natureza');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protocolo');
    }
};
