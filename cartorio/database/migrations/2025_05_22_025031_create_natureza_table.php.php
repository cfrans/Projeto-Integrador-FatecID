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
    Schema::create('natureza', function (Blueprint $table) {
        $table->id();
        $table->string('tipo', length: 50);
        $table->integer('dias_retorno');
        $table->string('tipo_dias_retorno', length: 10);
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
