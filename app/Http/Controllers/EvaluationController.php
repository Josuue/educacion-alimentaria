<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Auth::user()->evaluations()->orderBy('created_at', 'desc')->get();
        return view('pages.evaluacion.index', compact('evaluations'));
    }

    public function create()
    {
        return view('pages.evaluacion.create');
    }

    //AQUI ESTAN LAS FORMULAS QUE HACEN LOS CALCULOS

    public function store(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:1|max:300',
            'height' => 'required|numeric|min:50|max:250',
            'waist_circumference' => 'nullable|numeric|min:40|max:200',
            'hip_circumference' => 'nullable|numeric|min:40|max:200',
            'wrist_circumference' => 'nullable|numeric|min:5|max:30',
            'arm_circumference' => 'nullable|numeric',
            'triceps_skinfold' => 'nullable|numeric',
            'usual_weight' => 'nullable|numeric',
            'activity_level' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'sexo' => 'required|in:masculino,femenino',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['evaluation_date'] = now();

        // Calcular edad
        if (!empty($validated['birth_date'])) {
            $edadCalculada = Carbon::parse($validated['birth_date'])->age;
            $validated['edad'] = $edadCalculada;
        } else {
            $edadCalculada = null;
        }

        // Calcular IMC
        $altura_m = $validated['height'] / 100;
        $bmi = round($validated['weight'] / ($altura_m * $altura_m), 2);
        $validated['bmi'] = $bmi;

        //duplicado de imc
        $validated['indice_masa_corporal'] = $bmi;


        // Calcular complexion
        if (!empty($validated['height']) && !empty($validated['wrist_circumference']) && !empty($validated['sexo'])) {
            $indice = $validated['height'] / $validated['wrist_circumference'];

            if ($validated['sexo'] === 'masculino') {
                $validated['complexion'] = $indice < 9.6 ? 'Grande' : ($indice <= 10.4 ? 'Mediana' : 'Pequeña');
            } else {
                $validated['complexion'] = $indice < 10.1 ? 'Grande' : ($indice <= 11.1 ? 'Mediana' : 'Pequeña');
            }
        }


// 1. Peso ideal
$ki = 0;
if (!empty($validated['complexion']) && $validated['sexo']) {
    if ($validated['sexo'] === 'masculino') {
        $ki = $validated['complexion'] === 'Grande' ? 22.5 : ($validated['complexion'] === 'Mediana' ? 22 : 21.5);
    } elseif ($validated['sexo'] === 'femenino') {
        $ki = $validated['complexion'] === 'Grande' ? 21.5 : ($validated['complexion'] === 'Mediana' ? 21 : 20.5);
    }
}
$validated['peso_ideal'] = round(($altura_m * $altura_m) * $ki, 2);

// 2. % Peso ideal
if (!empty($validated['peso_ideal'])) {
    $validated['porcentaje_peso_ideal'] = round(($validated['weight'] / $validated['peso_ideal']) * 100, 2);
}

// 3. % Peso habitual
if (!empty($validated['usual_weight'])) {
    $validated['porcentaje_peso_habitual'] = round(($validated['weight'] / $validated['usual_weight']) * 100, 2);
}

// 4. % Cambio reciente de peso
if (!empty($validated['usual_weight']) && !empty($validated['weight'])) {
    $validated['porcentaje_cambio_peso'] = round((($validated['usual_weight'] - $validated['weight']) / $validated['usual_weight']) * 100, 2);
}

// 5. % Pliegue triceps
if (!empty($validated['triceps_skinfold']) && !empty($validated['sexo'])) {
    $kii = $validated['sexo'] === 'masculino' ? 11.5 : 24.5;
    $validated['porcentaje_pliegue_triceps'] = round(($validated['triceps_skinfold'] / $kii) * 100, 2);
}


// 6 y 7. Cálculo de CMB y %CMB
if (!empty($validated['arm_circumference']) && !empty($validated['triceps_skinfold']) && !empty($validated['sexo'])) {
    // Paso 1: Calcular CMB
    $cmb = $validated['arm_circumference'] - (0.314 * $validated['triceps_skinfold']);
    $validated['circunferencia_muscular_brazo'] = round($cmb, 2);

    // Paso 2: Calcular %CMB usando el Kii correspondiente
    $kii_cmb = $validated['sexo'] === 'masculino' ? 25.3 : 23.2;
    $validated['porcentaje_circunferencia_muscular_brazo'] = round(($cmb / $kii_cmb) * 100, 2);
}


// 7. Área muscular del brazo (aprox.)
if (!empty($validated['circunferencia_muscular_brazo'])) {
    $validated['area_muscular_brazo'] = round(pow($validated['circunferencia_muscular_brazo'], 2) / (4 * 3.14), 2);
}

// 8. Área de superficie corporal
$validated['area_superficie_corporal'] = round(0.007184 * pow($validated['weight'], 0.425) * pow($validated['height'], 0.725), 2);

// 9. Peso corporal magro
if ($validated['sexo'] === 'masculino') {
    $validated['peso_corporal_magro'] = round((1.1 * $validated['weight']) - 128 * pow(($validated['weight'] / $validated['height']), 2), 2);
} else {
    $validated['peso_corporal_magro'] = round((1.07 * $validated['weight']) - 148 * pow(($validated['weight'] / $validated['height']), 2), 2);
}

// 10. Índice cintura-estatura
if (!empty($validated['waist_circumference'])) {
    $validated['indice_cintura_estatura'] = round($validated['waist_circumference'] / $validated['height'], 2);
}







        // Crear evaluación
        $evaluation = Evaluation::create($validated);
        $this->generateDiagnosis($evaluation); // Generar diagnóstico automáticamente

        return back()->with([
            'success' => 'Evaluación registrada correctamente.',
            'imc' => $bmi,
            'edad' => $edadCalculada,
            'resumen' => $validated,
        ]);

    }

    public function show(Evaluation $evaluation)
    {
        $this->authorize('view', $evaluation);
        return view('pages.evaluacion.show', compact('evaluation'));
    }

    public function edit(Evaluation $evaluation)
    {
        $this->authorize('update', $evaluation);
        return view('pages.evaluacion.edit', compact('evaluation'));
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $this->authorize('update', $evaluation);

        $validated = $request->validate([
            'weight' => 'required|numeric|min:1|max:300',
            'height' => 'required|numeric|min:50|max:250',
            'waist_circumference' => 'nullable|numeric|min:40|max:200',
            'activity_level' => 'required|in:sedentario,ligero,moderado,intenso,muy_intenso',
            'knowledge_score' => 'nullable|integer|min:0|max:100',
            'basic_knowledge_score' => 'nullable|integer|min:0|max:100',
            'food_groups_score' => 'nullable|integer|min:0|max:100',
            'meal_planning_score' => 'nullable|integer|min:0|max:100',
            'nutrition_label_score' => 'nullable|integer|min:0|max:100',
            'eating_habits_score' => 'nullable|integer|min:0|max:100',
            'physical_activity_score' => 'nullable|integer|min:0|max:100',
            'wrist_circumference' => 'nullable|numeric|min:5|max:30',
            'sexo' => 'required|in:masculino,femenino',
        ]);

        $evaluation->update($validated);

        $this->updateDiagnosis($evaluation);

        return redirect()->route('evaluacion.show', $evaluation->id)
            ->with('success', 'Evaluación actualizada con éxito.');
    }

    public function destroy(Evaluation $evaluation)
    {
        $this->authorize('delete', $evaluation);
        $evaluation->delete();
        return redirect()->route('evaluacion.index')
            ->with('success', 'Evaluación eliminada con éxito.');
    }

    private function generateDiagnosis(Evaluation $evaluation)
    {
        $height_m = $evaluation->height / 100;
        $bmi = $evaluation->weight / ($height_m * $height_m);

        $bmi_category = 'normal';
        if ($bmi < 18.5) {
            $bmi_category = 'bajo_peso';
        } elseif ($bmi >= 25 && $bmi < 30) {
            $bmi_category = 'sobrepeso';
        } elseif ($bmi >= 30) {
            $bmi_category = 'obesidad';
        }

        $cardiovascular_risk = 'bajo';
        if ($evaluation->waist_circumference) {
            $gender = $evaluation->sexo ?? 'masculino';

            if ($gender == 'masculino' && $evaluation->waist_circumference > 102) {
                $cardiovascular_risk = 'alto';
            } elseif ($gender == 'femenino' && $evaluation->waist_circumference > 88) {
                $cardiovascular_risk = 'alto';
            } elseif ($gender == 'masculino' && $evaluation->waist_circumference > 94) {
                $cardiovascular_risk = 'moderado';
            } elseif ($gender == 'femenino' && $evaluation->waist_circumference > 80) {
                $cardiovascular_risk = 'moderado';
            }
        }

        $improve_food_groups = $evaluation->food_groups_score < 70;
        $improve_meal_planning = $evaluation->meal_planning_score < 70;
        $improve_nutrition_label = $evaluation->nutrition_label_score < 70;
        $improve_eating_habits = $evaluation->eating_habits_score < 70;
        $improve_physical_activity = $evaluation->physical_activity_score < 70;

        $nutrition_recommendations = $this->generateNutritionRecommendations($evaluation, $bmi_category);
        $physical_activity_recommendations = $this->generatePhysicalActivityRecommendations($evaluation, $bmi_category);
        $education_recommendations = $this->generateEducationRecommendations($evaluation);

        Diagnosis::create([
            'user_id' => $evaluation->user_id,
            'evaluation_id' => $evaluation->id,
            'bmi' => round($bmi, 2),
            'bmi_category' => $bmi_category,
            'cardiovascular_risk' => $cardiovascular_risk,
            'improve_food_groups' => $improve_food_groups,
            'improve_meal_planning' => $improve_meal_planning,
            'improve_nutrition_label' => $improve_nutrition_label,
            'improve_eating_habits' => $improve_eating_habits,
            'improve_physical_activity' => $improve_physical_activity,
            'nutrition_recommendations' => $nutrition_recommendations,
            'physical_activity_recommendations' => $physical_activity_recommendations,
            'education_recommendations' => $education_recommendations,
            'diagnosis_date' => now(),
        ]);
    }

    private function updateDiagnosis(Evaluation $evaluation)
    {
        if ($evaluation->diagnosis) {
            $height_m = $evaluation->height / 100;
            $bmi = $evaluation->weight / ($height_m * $height_m);

            $bmi_category = 'normal';
            if ($bmi < 18.5) {
                $bmi_category = 'bajo_peso';
            } elseif ($bmi >= 25 && $bmi < 30) {
                $bmi_category = 'sobrepeso';
            } elseif ($bmi >= 30) {
                $bmi_category = 'obesidad';
            }

            $evaluation->diagnosis->update([
                'bmi' => round($bmi, 2),
                'bmi_category' => $bmi_category,
            ]);
        } else {
            $this->generateDiagnosis($evaluation);
        }
    }

    private function generateNutritionRecommendations(Evaluation $evaluation, $bmi_category)
    {
        $recommendations = [];

        if ($bmi_category == 'bajo_peso') {
            $recommendations[] = 'Aumenta tu ingesta calórica con alimentos nutritivos como frutos secos, aguacate y aceites saludables.';
            $recommendations[] = 'Incluye proteínas de alta calidad en cada comida.';
        } elseif ($bmi_category == 'sobrepeso' || $bmi_category == 'obesidad') {
            $recommendations[] = 'Reduce el consumo de alimentos procesados y azúcares añadidos.';
            $recommendations[] = 'Aumenta el consumo de frutas, verduras y fibra.';
            $recommendations[] = 'Controla el tamaño de las porciones.';
        }

        $recommendations[] = 'Consume al menos 5 porciones de frutas y verduras al día.';
        $recommendations[] = 'Bebe al menos 8 vasos de agua al día.';
        $recommendations[] = 'Limita el consumo de sal a menos de 5g al día.';

        return implode("\n", $recommendations);
    }

    private function generatePhysicalActivityRecommendations(Evaluation $evaluation, $bmi_category)
    {
        $recommendations = [];

        if ($evaluation->activity_level == 'sedentario' || $evaluation->activity_level == 'ligero') {
            $recommendations[] = 'Comienza con 30 minutos de actividad física moderada, como caminar, 5 días a la semana.';
            $recommendations[] = 'Incorpora actividades que disfrutes para mantener la motivación.';
        } elseif ($evaluation->activity_level == 'moderado') {
            $recommendations[] = 'Aumenta gradualmente la intensidad de tu actividad física.';
            $recommendations[] = 'Incluye ejercicios de fuerza 2-3 veces por semana.';
        } elseif ($evaluation->activity_level == 'intenso' || $evaluation->activity_level == 'muy_intenso') {
            $recommendations[] = 'Mantén tu nivel de actividad física, asegurándote de incluir días de descanso.';
            $recommendations[] = 'Incorpora ejercicios de flexibilidad y movilidad.';
        }

        $recommendations[] = 'Reduce el tiempo sedentario, levántate y muévete cada hora.';
        $recommendations[] = 'Busca oportunidades para ser activo durante el día (usar escaleras, caminar más, etc.).';

        return implode("\n", $recommendations);
    }

    private function generateEducationRecommendations(Evaluation $evaluation)
    {
        $recommendations = [];

        if ($evaluation->food_groups_score < 70) {
            $recommendations[] = 'Revisa el módulo educativo sobre grupos de alimentos.';
        }

        if ($evaluation->meal_planning_score < 70) {
            $recommendations[] = 'Revisa el módulo educativo sobre planificación de comidas.';
        }

        if ($evaluation->nutrition_label_score < 70) {
            $recommendations[] = 'Revisa el módulo educativo sobre etiquetado nutricional.';
        }

        $recommendations[] = 'Programa una entrevista motivacional para recibir orientación personalizada.';
        $recommendations[] = 'Activa las notificaciones diarias para recibir consejos y recordatorios.';

        return implode("\n", $recommendations);
    }
}
