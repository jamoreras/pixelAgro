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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('areaHa', 100);
            $table->string('estado', 100);
            $table->unsignedBigInteger('idFinca'); // Relación con fincas
            $table->unsignedBigInteger('idCompany'); // Agregar columna para la compañía
            $table->timestamps();

            $table->foreign('idFinca')->references('id')->on('fincas'); // Foreign key constraint
            $table->foreign('idCompany')->references('id')->on('companies'); // Foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lotes', function (Blueprint $table) {
            $table->dropForeign(['idFinca']);
            $table->dropForeign(['idCompany']); // Eliminar clave foránea de idCompany
        });

        Schema::dropIfExists('lotes');
    }
};
