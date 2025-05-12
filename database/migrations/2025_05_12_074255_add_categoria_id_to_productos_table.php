<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriaIdToProductosTable extends Migration
{
    /**
     * Ejecuta las modificaciones de la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id')->nullable()->after('stock'); // Agregar columna categoria_id
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null'); // Relacionar con la tabla categorias
        });
    }

    /**
     * Revertir las modificaciones de la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
        });
    }
}
