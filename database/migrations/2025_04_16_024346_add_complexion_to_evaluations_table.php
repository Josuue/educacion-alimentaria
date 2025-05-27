<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()

    {
        // Esta migración está comentada porque el campo 'complexion' ya existe en la tabla
        /*
        Schema::table('evaluations', function (Blueprint $table) {
            $table->string('complexion')->nullable();
        });
        */
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void

    {
        /*
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn('complexion');
        });
        */
    }

};
