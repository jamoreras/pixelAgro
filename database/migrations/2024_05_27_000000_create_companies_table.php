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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 100);
            $table->string('nombreComercial', 100);
            $table->string('razonSocial', 100);
            $table->string('direccion', 100);
            $table->string('telefono', 100);
            $table->string('telefono2', 100)->nullable();
            $table->string('email', 100);
            $table->string('estado')->default('activo'); // Campo estado 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

