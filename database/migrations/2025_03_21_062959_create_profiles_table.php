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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('age')->nullable();
            $table->enum('gender', ['masculino', 'femenino', 'otro'])->nullable();
            $table->decimal('weight', 5, 2)->nullable(); // Peso en kg
            $table->decimal('height', 5, 2)->nullable(); // Altura en cm
            $table->decimal('waist_circumference', 5, 2)->nullable(); // Circunferencia de cintura en cm
            $table->enum('activity_level', ['sedentario', 'ligero', 'moderado', 'intenso', 'muy_intenso'])->nullable();
            $table->text('objectives')->nullable(); // Objetivos personales
            $table->string('telegram_username')->nullable(); // Usuario de Telegram
            $table->boolean('is_premium')->default(false); // Si el usuario tiene acceso premium
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
