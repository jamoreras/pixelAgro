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
            $table->timestamps();

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
        });

        Schema::dropIfExists('agrupaciones');
    }
}
