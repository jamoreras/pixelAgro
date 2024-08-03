<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bloques', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('areaHa', 8, 2);
            $table->string('estado');
            $table->unsignedBigInteger('idLote');
            $table->unsignedBigInteger('idCompany'); // Agregar columna para la compañía
            $table->timestamps();

            // Definir la relación con lotes
            $table->foreign('idLote')->references('id')->on('lotes');
            // Definir la relación con compañías
            $table->foreign('idCompany')->references('id')->on('companies');
        });
    }

    public function down(): void
    {
        Schema::table('bloques', function (Blueprint $table) {
            $table->dropForeign(['idLote']);
            $table->dropForeign(['idCompany']); // Eliminar clave foránea de idCompany
        });

        Schema::dropIfExists('bloques');
    }
};
