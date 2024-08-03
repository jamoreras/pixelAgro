<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgrupacionBloqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrupacion_bloque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agrupacion_id')->constrained('agrupaciones')->onDelete('cascade');
            $table->foreignId('bloque_id')->constrained('bloques')->onDelete('cascade');
            $table->unsignedBigInteger('idCompany'); // Campo para la compañía
          //  $table->foreign('idCompany')->references('id')->on('companies')->onDelete('cascade'); // Clave foránea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agrupacion_bloque', function (Blueprint $table) {
            $table->dropForeign(['agrupacion_id']);
            $table->dropForeign(['bloque_id']);
          //  $table->dropForeign(['idCompany']); // Eliminar clave foránea
        });

        Schema::dropIfExists('agrupacion_bloque');
    }
}
