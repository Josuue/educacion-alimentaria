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
    Schema::table('evaluations', function (Blueprint $table) {
        $table->float('wrist_circumference')->nullable();
        $table->float('usual_weight')->nullable();
        $table->float('triceps_skinfold')->nullable();
        $table->float('arm_circumference')->nullable();
        $table->float('hip_circumference')->nullable();
        $table->date('birth_date')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn([
                'wrist_circumference',
                'usual_weight',
                'triceps_skinfold',
                'arm_circumference',
                'hip_circumference',
                'birth_date',
            ]);
        });
    }

};
