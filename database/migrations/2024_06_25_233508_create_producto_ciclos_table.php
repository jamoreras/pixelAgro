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
        Schema::create('producto_ciclos', function (Blueprint $table) {
            $table->id();
            $table->string('dosisHa', 100);
            $table->string('unidadMedida', 100);
            $table->string('estado', 100);


            
            $table->unsignedBigInteger('idPrograma');
            $table->unsignedBigInteger('idCiclo');
            $table->unsignedBigInteger('idProducto');//filtrar por clasificacion no por tabla
            $table->unsignedBigInteger('idCompany');

            $table->timestamps();

            // Claves foráneas
            $table->foreign('idPrograma')->references('id')->on('programas');
            $table->foreign('idCiclo')->references('id')->on('ciclos');
            $table->foreign('idProducto')->references('id')->on('productos');
            $table->foreign('idCompany')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_ciclos');
    }
};
