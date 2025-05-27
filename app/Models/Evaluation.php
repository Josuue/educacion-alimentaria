<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'weight',
        'height',
        'waist_circumference',
        'activity_level',
        'bmi',
        'wrist_circumference', // Circunferencia muñeca
        'usual_weight',         // Peso usual
        'triceps_skinfold',     // PCT
        'arm_circumference',    // Perímetro braquial
        'hip_circumference',    // Circunferencia de la cadera
        'birth_date',           // Fecha de nacimiento
        'evaluation_date',
        'edad',                 // Edad calculada
        'sexo',
        'complexion',
        'peso_ideal',
        'porcentaje_peso_ideal',
        'porcentaje_peso_habitual',
        'porcentaje_cambio_peso',
        'porcentaje_pliegue_triceps',
        'circunferencia_muscular_brazo',
        'area_muscular_brazo',
        'area_superficie_corporal',
        'peso_corporal_magro',
        'indice_cintura_estatura',
        'indice_masa_corporal',


        // agrega más si los usas
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'evaluation_date' => 'datetime',
    ];

    /**
     * Get the user that owns the evaluation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the diagnosis associated with the evaluation.
     */
    public function diagnosis()
    {
        return $this->hasOne(Diagnosis::class);
    }
}
