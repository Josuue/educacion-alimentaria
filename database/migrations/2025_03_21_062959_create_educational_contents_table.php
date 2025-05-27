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
        Schema::create('educational_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['grupos_alimentos', 'etiquetado_nutricional', 'planificacion_comidas', 'habitos_alimentarios', 'actividad_fisica', 'otro']);
            $table->string('image_url')->nullable();
            $table->string('resource_url')->nullable(); // URL para recursos descargables
            $table->string('resource_type')->nullable(); // Tipo de recurso (PDF, PNG, etc.)
            $table->integer('duration_minutes')->nullable(); // Duración estimada en minutos
            $table->boolean('is_premium')->default(false); // Si es contenido premium
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_contents');
    }
};
