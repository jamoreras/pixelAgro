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
            $table->unsignedBigInteger('idCompany'); // Campo para la compañía
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idClasificacion')->references('id')->on('clasificaciones');
            $table->foreign('idCompany')->references('id')->on('companies');
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
