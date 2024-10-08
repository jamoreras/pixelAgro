<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgrupacionesTable extends Migration
{
    public function up()
    {
        Schema::create('agrupaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('fechaInicio');
            $table->decimal('areaTotal', 10, 2);
            $table->string('estado');
            $table->string('ciclo'); 
            $table->string('finca_id');//nueva
            $table->string('lote_id');//nueva
            $table->timestamps();

            // Agregar columna para la compañía
            $table->unsignedBigInteger('idCompany'); // Relación con la tabla companies
            $table->foreign('idCompany')->references('id')->on('companies');

            // Definir la relación con bloques
            $table->unsignedBigInteger('idBloque')->nullable(); // Hacer la columna nullable si no siempre estará presente
            $table->foreign('idBloque')->references('id')->on('bloques');
        });
    }

    public function down()
    {
        Schema::table('agrupaciones', function (Blueprint $table) {
            $table->dropForeign(['idBloque']);
            $table->dropColumn('idBloque');
            $table->dropForeign(['idCompany']); // Eliminar clave foránea de idCompany
        });

        Schema::dropIfExists('agrupaciones');
    }
}
