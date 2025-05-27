<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagnoses = Auth::user()->diagnoses()->orderBy('created_at', 'desc')->get();
        return view('pages.diagnostico.index', compact('diagnoses'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnosis $diagnosis)
    {
        $this->authorize('view', $diagnosis);
        return view('pages.diagnostico.show', compact('diagnosis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnosis $diagnosis)
    {
        $this->authorize('update', $diagnosis);
        return view('pages.diagnostico.edit', compact('diagnosis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnosis $diagnosis)
    {
        $this->authorize('update', $diagnosis);
        
        $validated = $request->validate([
            'nutrition_recommendations' => 'nullable|string',
            'physical_activity_recommendations' => 'nullable|string',
            'education_recommendations' => 'nullable|string',
        ]);

        $diagnosis->update($validated);

        return redirect()->route('diagnostico.show', $diagnosis->id)
            ->with('success', 'Diagnóstico actualizado con éxito.');
    }

    /**
     * Get diagnosis data for charts.
     */
    public function getChartData(Diagnosis $diagnosis)
    {
        $this->authorize('view', $diagnosis);
        
        // Datos para gráfico de IMC
        $bmiData = [
            'current' => $diagnosis->bmi,
            'category' => $diagnosis->bmi_category,
            'ranges' => [
                'bajo_peso' => ['min' => 0, 'max' => 18.5],
                'normal' => ['min' => 18.5, 'max' => 25],
                'sobrepeso' => ['min' => 25, 'max' => 30],
                'obesidad' => ['min' => 30, 'max' => 40]
            ]
        ];
        
        // Datos para gráfico de conocimientos
        $knowledgeData = [
            'labels' => [
                'Conocimientos Básicos',
                'Grupos de Alimentos',
                'Planificación de Comidas',
                'Etiquetado Nutricional',
                'Hábitos Alimentarios',
                'Actividad Física'
            ],
            'scores' => [
                $diagnosis->evaluation->basic_knowledge_score ?? 0,
                $diagnosis->evaluation->food_groups_score ?? 0,
                $diagnosis->evaluation->meal_planning_score ?? 0,
                $diagnosis->evaluation->nutrition_label_score ?? 0,
                $diagnosis->evaluation->eating_habits_score ?? 0,
                $diagnosis->evaluation->physical_activity_score ?? 0
            ]
        ];
        
        // Datos para gráfico de áreas de mejora
        $improvementData = [
            'labels' => [
                'Grupos de Alimentos',
                'Planificación de Comidas',
                'Etiquetado Nutricional',
                'Hábitos Alimentarios',
                'Actividad Física'
            ],
            'needs_improvement' => [
                $diagnosis->improve_food_groups ? 1 : 0,
                $diagnosis->improve_meal_planning ? 1 : 0,
                $diagnosis->improve_nutrition_label ? 1 : 0,
                $diagnosis->improve_eating_habits ? 1 : 0,
                $diagnosis->improve_physical_activity ? 1 : 0
            ]
        ];
        
        return response()->json([
            'bmi' => $bmiData,
            'knowledge' => $knowledgeData,
            'improvement' => $improvementData
        ]);
    }

    /**
     * Compare current diagnosis with previous ones.
     */
    public function compare(Diagnosis $diagnosis)
    {
        $this->authorize('view', $diagnosis);
        
        // Obtener diagnósticos anteriores del mismo usuario
        $previousDiagnoses = Auth::user()->diagnoses()
            ->where('id', '!=', $diagnosis->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Preparar datos para la comparación
        $comparisonData = [
            'dates' => [$diagnosis->diagnosis_date->format('d/m/Y')],
            'bmi' => [$diagnosis->bmi],
            'knowledge_scores' => [$diagnosis->evaluation->knowledge_score ?? 0]
        ];
        
        foreach ($previousDiagnoses as $prevDiagnosis) {
            $comparisonData['dates'][] = $prevDiagnosis->diagnosis_date->format('d/m/Y');
            $comparisonData['bmi'][] = $prevDiagnosis->bmi;
            $comparisonData['knowledge_scores'][] = $prevDiagnosis->evaluation->knowledge_score ?? 0;
        }
        
        // Invertir arrays para mostrar en orden cronológico
        $comparisonData['dates'] = array_reverse($comparisonData['dates']);
        $comparisonData['bmi'] = array_reverse($comparisonData['bmi']);
        $comparisonData['knowledge_scores'] = array_reverse($comparisonData['knowledge_scores']);
        
        return view('pages.diagnostico.compare', compact('diagnosis', 'previousDiagnoses', 'comparisonData'));
    }
}
