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
    Schema::create('parte', function (Blueprint $table) {
        $table->id();
        $table->string('identificacao', length: 100);
        $table->timestamps();
        $table->foreignId('id_tipo_parte')->constrained('tipo_parte');
        $table->foreignId('id_protocolo')->constrained('protocolo');
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
