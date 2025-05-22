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
    Schema::create('tipo_parte', function (Blueprint $table) {
        $table->id();
        $table->string('tipo', length: 20);
        $table->timestamps();
        $table->foreignId('id_natureza')->constrained('natureza');
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
