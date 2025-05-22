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
    Schema::create('andamento', function (Blueprint $table) {
        $table->id();
        $table->decimal('valor',10,2)->default(0.00);
        $table->string('observacao', length: 255);
        $table->foreignId('id_tipo_andamento')->constrained('tipo_andamento');
        $table->foreignId('id_usuario')->constrained('users');
        $table->foreignId('id_protocolo')->constrained('protocolo');
        $table->foreignId('id_tipo_parte')->constrained('tipo_parte');
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
