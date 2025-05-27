<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Diagnosis;
use App\Models\Task;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    /**
     * Display the monitoring dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $latestEvaluation = $user->evaluations()->latest()->first();
        $firstEvaluation = $user->evaluations()->oldest()->first();
        $completedTasks = $user->tasks()->where('status', 'completada')->count();
        $pendingTasks = $user->tasks()->whereIn('status', ['pendiente', 'en_progreso'])->count();
        
        // Datos para gráficos de evolución
        $evaluations = $user->evaluations()->orderBy('evaluation_date')->get();
        $chartData = $this->prepareChartData($evaluations);
        
        return view('pages.monitoreo.index', compact(
            'latestEvaluation', 
            'firstEvaluation', 
            'completedTasks', 
            'pendingTasks', 
            'chartData'
        ));
    }
    
    /**
     * Update user measurements.
     */
    public function updateMeasurements(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:1|max:300',
            'waist_circumference' => 'nullable|numeric|min:40|max:200',
            'measurement_date' => 'required|date',
        ]);
        
        $user = Auth::user();
        $latestEvaluation = $user->evaluations()->latest()->first();
        
        if (!$latestEvaluation) {
            return redirect()->route('evaluacion.create')
                ->with('error', 'Primero debes completar una evaluación inicial.');
        }
        
        // Crear nueva evaluación con los datos actualizados
        $newEvaluation = Evaluation::create([
            'user_id' => $user->id,
            'weight' => $validated['weight'],
            'height' => $latestEvaluation->height, // Mantener la altura anterior
            'waist_circumference' => $validated['waist_circumference'],
            'activity_level' => $latestEvaluation->activity_level, // Mantener el nivel de actividad anterior
            'evaluation_date' => $validated['measurement_date'],
        ]);
        
        // Generar diagnóstico automáticamente
        $this->generateDiagnosis($newEvaluation);
        
        return redirect()->route('monitoreo.index')
            ->with('success', 'Medidas actualizadas con éxito.');
    }
    
    /**
     * Display task progress.
     */
    public function taskProgress()
    {
        $user = Auth::user();
        $completedTasks = $user->tasks()->where('status', 'completada')->orderBy('completion_date', 'desc')->get();
        $pendingTasks = $user->tasks()->whereIn('status', ['pendiente', 'en_progreso'])->orderBy('due_date')->get();
        $cancelledTasks = $user->tasks()->where('status', 'cancelada')->get();
        
        // Calcular estadísticas
        $totalTasks = $completedTasks->count() + $pendingTasks->count() + $cancelledTasks->count();
        $completionRate = $totalTasks > 0 ? round(($completedTasks->count() / $totalTasks) * 100) : 0;
        
        return view('pages.monitoreo.task-progress', compact(
            'completedTasks', 
            'pendingTasks', 
            'cancelledTasks', 
            'totalTasks', 
            'completionRate'
        ));
    }
    
    /**
     * Display knowledge progress.
     */
    public function knowledgeProgress()
    {
        $user = Auth::user();
        $evaluations = $user->evaluations()->orderBy('evaluation_date')->get();
        
        if ($evaluations->isEmpty()) {
            return redirect()->route('evaluacion.create')
                ->with('error', 'Primero debes completar una evaluación inicial.');
        }
        
        // Preparar datos para gráficos
        $dates = $evaluations->pluck('evaluation_date')->map(function($date) {
            return $date->format('d/m/Y');
        })->toArray();
        
        $knowledgeScores = [
            'basic' => $evaluations->pluck('basic_knowledge_score')->toArray(),
            'food_groups' => $evaluations->pluck('food_groups_score')->toArray(),
            'meal_planning' => $evaluations->pluck('meal_planning_score')->toArray(),
            'nutrition_label' => $evaluations->pluck('nutrition_label_score')->toArray(),
            'eating_habits' => $evaluations->pluck('eating_habits_score')->toArray(),
            'physical_activity' => $evaluations->pluck('physical_activity_score')->toArray(),
        ];
        
        // Calcular mejoras
        $firstEvaluation = $evaluations->first();
        $latestEvaluation = $evaluations->last();
        
        $improvements = [
            'basic' => $this->calculateImprovement($firstEvaluation->basic_knowledge_score, $latestEvaluation->basic_knowledge_score),
            'food_groups' => $this->calculateImprovement($firstEvaluation->food_groups_score, $latestEvaluation->food_groups_score),
            'meal_planning' => $this->calculateImprovement($firstEvaluation->meal_planning_score, $latestEvaluation->meal_planning_score),
            'nutrition_label' => $this->calculateImprovement($firstEvaluation->nutrition_label_score, $latestEvaluation->nutrition_label_score),
            'eating_habits' => $this->calculateImprovement($firstEvaluation->eating_habits_score, $latestEvaluation->eating_habits_score),
            'physical_activity' => $this->calculateImprovement($firstEvaluation->physical_activity_score, $latestEvaluation->physical_activity_score),
        ];
        
        return view('pages.monitoreo.knowledge-progress', compact(
            'dates', 
            'knowledgeScores', 
            'improvements', 
            'firstEvaluation', 
            'latestEvaluation'
        ));
    }
    
    /**
     * Display payment management.
     */
    public function payments()
    {
        $user = Auth::user();
        $payments = $user->payments()->orderBy('created_at', 'desc')->get();
        $isPremium = $user->profile ? $user->profile->is_premium : false;
        
        return view('pages.monitoreo.payments', compact('payments', 'isPremium'));
    }
    
    /**
     * Register a new payment.
     */
    public function registerPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:transferencia,bizum',
            'reference' => 'required|string|max:255',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
        
        $validated['user_id'] = Auth::id();
        $validated['amount'] = 29.99; // Precio fijo del servicio premium
        $validated['status'] = 'pendiente';
        
        Payment::create($validated);
        
        return redirect()->route('monitoreo.payments')
            ->with('success', 'Pago registrado con éxito. Se verificará en las próximas 24 horas.');
    }
    
    /**
     * Generate a diagnosis based on evaluation data.
     */
    private function generateDiagnosis($evaluation)
    {
        // Calcular IMC
        $height_m = $evaluation->height / 100; // Convertir cm a m
        $bmi = $evaluation->weight / ($height_m * $height_m);
        
        // Determinar categoría de IMC
        $bmi_category = 'normal';
        if ($bmi < 18.5) {
            $bmi_category = 'bajo_peso';
        } elseif ($bmi >= 25 && $bmi < 30) {
            $bmi_category = 'sobrepeso';
        } elseif ($bmi >= 30) {
            $bmi_category = 'obesidad';
        }
        
        // Determinar riesgo cardiovascular basado en circunferencia de cintura
        $cardiovascular_risk = 'bajo';
        if ($evaluation->waist_circumference) {
            $gender = $evaluation->user->profile->gender ?? 'masculino';
            
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
        
        // Crear diagnóstico
        Diagnosis::create([
            'user_id' => $evaluation->user_id,
            'evaluation_id' => $evaluation->id,
            'bmi' => round($bmi, 2),
            'bmi_category' => $bmi_category,
            'cardiovascular_risk' => $cardiovascular_risk,
            'diagnosis_date' => now(),
        ]);
    }
    
    /**
     * Calculate improvement percentage between two scores.
     */
    private function calculateImprovement($initialScore, $currentScore)
    {
        if (!$initialScore || !$currentScore) {
            return 0;
        }
        
        return round((($currentScore - $initialScore) / $initialScore) * 100);
    }
    
    /**
     * Prepare chart data from evaluations.
     */
    private function prepareChartData($evaluations)
    {
        $dates = [];
        $weights = [];
        $bmis = [];
        $waistCircumferences = [];
        
        foreach ($evaluations as $evaluation) {
            $dates[] = $evaluation->evaluation_date->format('d/m/Y');
            $weights[] = $evaluation->weight;
            
            // Calcular IMC
            $height_m = $evaluation->height / 100; // Convertir cm a m
            $bmi = $evaluation->weight / ($height_m * $height_m);
            $bmis[] = round($bmi, 2);
            
            $waistCircumferences[] = $evaluation->waist_circumference;
        }
        
        return [
            'dates' => $dates,
            'weights' => $weights,
            'bmis' => $bmis,
            'waistCircumferences' => $waistCircumferences
        ];
    }
}
