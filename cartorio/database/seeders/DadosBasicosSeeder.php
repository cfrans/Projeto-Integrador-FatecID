<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DadosBasicosSeeder extends Seeder
{
    public function run(): void
    {
        // Grupo
        DB::table('grupo')->insert([
            ['id' => 1, 'tipo' => 'Títulos e Documentos'],
            ['id' => 2, 'tipo' => 'Pessoa Jurídica'],
        ]);

        // Natureza
        DB::table('natureza')->insert([
            ['id' => 1, 'tipo' => 'Ata de Condomínio', 'id_grupo' => 1],
            ['id' => 2, 'tipo' => 'Cédula de Crédito', 'id_grupo' => 1],
            ['id' => 3, 'tipo' => 'Conservação', 'id_grupo' => 1],
            ['id' => 4, 'tipo' => 'Notificação', 'id_grupo' => 1],
            ['id' => 5, 'tipo' => 'Tradução', 'id_grupo' => 1],
            ['id' => 6, 'tipo' => 'Ata de Assembleia', 'id_grupo' => 2],
            ['id' => 7, 'tipo' => 'Abertura de Filial', 'id_grupo' => 2],
            ['id' => 8, 'tipo' => 'Contrato Social', 'id_grupo' => 2],
            ['id' => 9, 'tipo' => 'Distrato', 'id_grupo' => 2],
            ['id' => 10, 'tipo' => 'Estatuto', 'id_grupo' => 2],
        ]);

        // Especie
        DB::table('especie')->insert([
            ['id' => 1, 'tipo' => 'Registro'],
            ['id' => 2, 'tipo' => 'Averbação'],
        ]);

        // Documento
        DB::table('documento')->insert([
            ['id' => 1, 'tipo' => 'RG'],
            ['id' => 2, 'tipo' => 'CPF'],
            ['id' => 3, 'tipo' => 'CNH'],
            ['id' => 4, 'tipo' => 'CNPJ'],
        ]);

        // Tipo Parte
        DB::table('tipo_parte')->insert([
            ['id' => 1, 'tipo' => 'Condomínio', 'id_grupo' => 1],
            ['id' => 2, 'tipo' => 'Destinatário', 'id_grupo' => 1],
            ['id' => 3, 'tipo' => 'Emitente', 'id_grupo' => 1],
            ['id' => 4, 'tipo' => 'Parte', 'id_grupo' => 1],
            ['id' => 5, 'tipo' => 'Remetente', 'id_grupo' => 1],
            ['id' => 6, 'tipo' => 'Síndico', 'id_grupo' => 1],
            ['id' => 7, 'tipo' => 'Associação', 'id_grupo' => 2],
            ['id' => 8, 'tipo' => 'Diretor Executivo', 'id_grupo' => 2],
            ['id' => 9, 'tipo' => 'Presidente', 'id_grupo' => 2],
            ['id' => 10, 'tipo' => 'Secretário', 'id_grupo' => 2],
            ['id' => 11, 'tipo' => 'Sócio', 'id_grupo' => 2],
        ]);
    }
}
