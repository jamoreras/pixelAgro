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
        Schema::create('ciclos', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre', 100);
            $table->string('estado', 100);
            $table->string('diasAplicacion', 100);
            $table->string('puntoPartida', 100);
            $table->string('motivo', 100);
            $table->string('litrosHa', 100);

            $table->unsignedBigInteger('idPrograma');
            $table->unsignedBigInteger('idCompany');
            $table->timestamps();
        
            // Claves foráneas
            $table->foreign('idPrograma')->references('id')->on('programas');
            $table->foreign('idCompany')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclos');
    }
};
