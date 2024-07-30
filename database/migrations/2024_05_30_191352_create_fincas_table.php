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
        Schema::create('fincas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('areaHa', 100);
            $table->string('estado', 100);
            $table->unsignedBigInteger('idCompany'); // relación con la tabla companies
            $table->timestamps();

            $table->foreign('idCompany')->references('id')->on('companies'); // Foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fincas');
    }
};
