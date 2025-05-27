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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('evaluation_id')->constrained()->onDelete('cascade');
            // Resultados del diagnóstico
            $table->decimal('bmi', 5, 2)->nullable(); // Índice de masa corporal
            $table->enum('bmi_category', ['bajo_peso', 'normal', 'sobrepeso', 'obesidad'])->nullable();
            $table->enum('cardiovascular_risk', ['bajo', 'moderado', 'alto', 'muy_alto'])->nullable();
            // Áreas de mejora identificadas
            $table->boolean('improve_food_groups')->default(false);
            $table->boolean('improve_meal_planning')->default(false);
            $table->boolean('improve_nutrition_label')->default(false);
            $table->boolean('improve_eating_habits')->default(false);
            $table->boolean('improve_physical_activity')->default(false);
            // Recomendaciones personalizadas
            $table->text('nutrition_recommendations')->nullable();
            $table->text('physical_activity_recommendations')->nullable();
            $table->text('education_recommendations')->nullable();
            // Fecha del diagnóstico
            $table->date('diagnosis_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
