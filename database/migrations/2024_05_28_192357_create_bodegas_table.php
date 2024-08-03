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
        Schema::create('bodegas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCompany'); // relación con la tabla companies
            $table->string('descripcion', 100);
            $table->string('ubicacion', 255);
            $table->enum('estado', ['activo', 'inactivo']);
            $table->timestamps();

            $table->foreign('idCompany')->references('id')->on('companies'); // Foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodegas');
    }
};
