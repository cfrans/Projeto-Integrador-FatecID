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
        // Cria a sequence
        DB::statement("CREATE SEQUENCE IF NOT EXISTS seq_numero_protocolo START WITH 1 INCREMENT BY 1");

        // Cria a tabela protocolo
        Schema::create('protocolo', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_documento');
            $table->date('data_documento');
            $table->date('data_abertura')->default(DB::raw('CURRENT_DATE'));
            $table->date('data_cancelamento')->nullable();
            $table->integer('numero_protocolo')->nullable();
            $table->integer('numero_registro')->nullable();
            $table->dateTime('data_retirada')->nullable();
            $table->dateTime('data_registro')->nullable();

            // Relacionamentos
            $table->foreignId('id_usuario')->constrained('usuario');
            $table->foreignId('id_apresentante')->constrained('apresentante');
            $table->foreignId('id_grupo')->constrained('grupo');
            $table->foreignId('id_especie')->constrained('especie');
            $table->foreignId('id_natureza')->constrained('natureza');

            $table->timestamps();
        });

        // Cria a função atribui_numero_protocolo()
        DB::unprepared("
            CREATE OR REPLACE FUNCTION atribui_numero_protocolo()
            RETURNS TRIGGER AS \$\$
            BEGIN
                IF NEW.numero_protocolo IS NULL THEN
                    NEW.numero_protocolo := nextval('seq_numero_protocolo');
                END IF;
                RETURN NEW;
            END;
            \$\$ LANGUAGE plpgsql;
        ");

        // Cria a trigger que chama a função
        DB::unprepared("
            CREATE TRIGGER trg_numero_protocolo
            BEFORE INSERT ON protocolo
            FOR EACH ROW
            EXECUTE FUNCTION atribui_numero_protocolo();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove trigger, function, sequence e tabela
        DB::statement("DROP TRIGGER IF EXISTS trg_numero_protocolo ON protocolo");
        DB::statement("DROP FUNCTION IF EXISTS atribui_numero_protocolo()");
        DB::statement("DROP SEQUENCE IF EXISTS seq_numero_protocolo");

        Schema::dropIfExists('protocolo');
    }
};
