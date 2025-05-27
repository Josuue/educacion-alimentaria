<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'evaluation_id',
        'bmi',
        'bmi_category',
        'cardiovascular_risk',
        'improve_food_groups',
        'improve_meal_planning',
        'improve_nutrition_label',
        'improve_eating_habits',
        'improve_physical_activity',
        'nutrition_recommendations',
        'physical_activity_recommendations',
        'education_recommendations',
        'diagnosis_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'improve_food_groups' => 'boolean',
        'improve_meal_planning' => 'boolean',
        'improve_nutrition_label' => 'boolean',
        'improve_eating_habits' => 'boolean',
        'improve_physical_activity' => 'boolean',
        'diagnosis_date' => 'date',
    ];

    /**
     * Get the user that owns the diagnosis.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the evaluation that owns the diagnosis.
     */
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
