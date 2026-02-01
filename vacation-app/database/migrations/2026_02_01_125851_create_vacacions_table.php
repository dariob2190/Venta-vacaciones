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
        Schema::create('vacacions', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->decimal('precio_por_persona', 10, 2);
            $table->string('ciudad');
            $table->integer('duracion_dias');
            $table->text('itinerario');
            $table->foreignId('id_tipo')->constrained('tipos')->onDelete('cascade');
            $table->string('pais');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacacions');
    }
};
