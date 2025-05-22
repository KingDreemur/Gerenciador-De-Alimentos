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
        Schema::table('alimentos', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id')->nullable()->after('validade'); 
            // Se quiser forçar que sempre tenha categoria, tire o nullable()

            // Opcional: se quiser criar a foreign key (assumindo que existe tabela 'categorias' com coluna 'id')
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alimentos', function (Blueprint $table) {
            // Para desfazer a foreign key antes de apagar a coluna
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
        });
    }
};
