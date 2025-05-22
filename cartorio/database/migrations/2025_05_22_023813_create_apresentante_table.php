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
    Schema::create('apresentante', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_documento')->constrained('documento');
        $table->string('numero_documento', 20);
        $table->string('nome', 64);
        $table->string('numero_contato', 15);
        $table->string('email', 100);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apresentantes');
    }
};
