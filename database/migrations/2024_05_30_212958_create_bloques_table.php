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
            $table->timestamps();

            // Definir la relación con lotes
            $table->foreign('idLote')->references('id')->on('lotes');
        });
    }

    public function down(): void
    {
        Schema::table('bloques', function (Blueprint $table) {
            $table->dropForeign(['idLote']);
        });

        Schema::dropIfExists('bloques');
    }
};
