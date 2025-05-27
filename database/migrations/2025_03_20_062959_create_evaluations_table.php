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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Datos antropométricos
            $table->decimal('weight', 5, 2)->nullable(); // Peso en kg
            $table->decimal('height', 5, 2)->nullable(); // Altura en cm
            $table->decimal('waist_circumference', 5, 2)->nullable(); // Circunferencia de cintura en cm
            $table->enum('activity_level', ['sedentario', 'ligero', 'moderado', 'intenso', 'muy_intenso'])->nullable();
            // Resultados de la prueba de conocimientos
            $table->integer('knowledge_score')->nullable(); // Puntuación general
            $table->integer('basic_knowledge_score')->nullable(); // Conocimientos básicos
            $table->integer('food_groups_score')->nullable(); // Grupos de alimentos
            $table->integer('meal_planning_score')->nullable(); // Planificación de comidas
            $table->integer('nutrition_label_score')->nullable(); // Etiquetado nutricional
            $table->integer('eating_habits_score')->nullable(); // Hábitos alimentarios
            $table->integer('physical_activity_score')->nullable(); // Actividad física
            // Fecha de evaluación
            $table->date('evaluation_date');
            $table->timestamps();

            //agregados por josue
            $table->string('complexion')->nullable();
            $table->float('peso_ideal')->nullable();
            $table->float('porcentaje_peso_ideal')->nullable();
            $table->float('porcentaje_peso_habitual')->nullable();
            $table->float('porcentaje_cambio_peso')->nullable();
            $table->float('porcentaje_pliegue_triceps')->nullable();
            $table->float('circunferencia_muscular_brazo')->nullable();
            $table->float('area_muscular_brazo')->nullable();
            $table->float('indice_masa_corporal')->nullable(); // ya lo tienes como bmi
            $table->float('area_superficie_corporal')->nullable();
            $table->float('peso_corporal_magro')->nullable();
            $table->float('indice_cintura_estatura')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
