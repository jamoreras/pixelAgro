<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idClasificacion');
            $table->string('nombreProducto', 100);
            $table->string('nombreComercial', 100);
            $table->string('ingredienteActivo', 100);
            $table->string('dosis', 100);
            $table->string('periodoReingreso', 100);
            $table->string('unidadMedida', 100);
            $table->string('esperaCosecha', 100);
            $table->enum('estado', ['activo', 'inactivo'])->default('activo'); 
            $table->timestamps();

            $table->foreign('idClasificacion')->references('id')->on('clasificaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
