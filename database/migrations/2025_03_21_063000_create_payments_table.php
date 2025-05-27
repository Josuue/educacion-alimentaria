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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->enum('payment_method', ['transferencia', 'bizum']);
            $table->enum('status', ['pendiente', 'completado', 'rechazado'])->default('pendiente');
            $table->string('reference')->nullable(); // Referencia de pago
            $table->text('notes')->nullable(); // Notas adicionales
            $table->date('payment_date')->nullable(); // Fecha de pago
            $table->date('verification_date')->nullable(); // Fecha de verificación
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
