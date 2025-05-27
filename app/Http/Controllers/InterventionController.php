<?php

namespace App\Http\Controllers;

use App\Models\EducationalContent;
use App\Models\Interview;
use App\Models\Task;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterventionController extends Controller
{
    /**
     * Display the intervention dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $educationalContents = EducationalContent::all()->take(6);
        $upcomingInterview = $user->interviews()
            ->where('status', 'programada')
            ->where('scheduled_at', '>', now())
            ->orderBy('scheduled_at')
            ->first();
        $tasks = $user->tasks()->orderBy('due_date')->get();
        
        return view('pages.intervencion.index', compact('educationalContents', 'upcomingInterview', 'tasks'));
    }
    
    /**
     * Display educational content.
     */
    public function educationalContent()
    {
        $categories = [
            'grupos_alimentos' => 'Grupos de Alimentos',
            'etiquetado_nutricional' => 'Etiquetado Nutricional',
            'planificacion_comidas' => 'Planificación de Comidas',
            'habitos_alimentarios' => 'Hábitos Alimentarios',
            'actividad_fisica' => 'Actividad Física',
            'otro' => 'Otros Temas'
        ];
        
        $contents = EducationalContent::all();
        
        return view('pages.intervencion.educational-content', compact('categories', 'contents'));
    }
    
    /**
     * Show a specific educational content.
     */
    public function showEducationalContent(EducationalContent $content)
    {
        // Verificar si el contenido es premium y el usuario no tiene acceso premium
        if ($content->is_premium && !Auth::user()->profile->is_premium) {
            return redirect()->route('intervencion.educational-content')
                ->with('error', 'Este contenido es exclusivo para usuarios premium.');
        }
        
        return view('pages.intervencion.show-content', compact('content'));
    }
    
    /**
     * Display interview management.
     */
    public function interviews()
    {
        $user = Auth::user();
        $upcomingInterview = $user->interviews()
            ->where('status', 'programada')
            ->where('scheduled_at', '>', now())
            ->orderBy('scheduled_at')
            ->first();
        
        $pastInterviews = $user->interviews()
            ->where('status', 'completada')
            ->orderBy('scheduled_at', 'desc')
            ->get();
        
        return view('pages.intervencion.interviews', compact('upcomingInterview', 'pastInterviews'));
    }
    
    /**
     * Schedule a new interview.
     */
    public function scheduleInterview(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after:today',
            'time' => 'required|string',
        ]);
        
        // Combinar fecha y hora
        $scheduledAt = $validated['date'] . ' ' . $validated['time'] . ':00';
        
        // Crear entrevista
        $interview = Interview::create([
            'user_id' => Auth::id(),
            'scheduled_at' => $scheduledAt,
            'status' => 'programada',
            'jitsi_room_id' => 'educacionAlimentaria' . uniqid(),
        ]);
        
        return redirect()->route('intervencion.interviews')
            ->with('success', 'Entrevista programada con éxito para el ' . date('d/m/Y H:i', strtotime($scheduledAt)));
    }
    
    /**
     * Join an interview.
     */
    public function joinInterview(Interview $interview)
    {
        $this->authorize('view', $interview);
        
        if ($interview->status != 'programada') {
            return redirect()->route('intervencion.interviews')
                ->with('error', 'Esta entrevista no está disponible para unirse.');
        }
        
        // Actualizar estado de la entrevista
        $interview->update([
            'started_at' => now(),
            'status' => 'en_curso'
        ]);
        
        return view('pages.intervencion.join-interview', compact('interview'));
    }
    
    /**
     * Complete an interview.
     */
    public function completeInterview(Interview $interview)
    {
        $this->authorize('update', $interview);
        
        $interview->update([
            'ended_at' => now(),
            'status' => 'completada'
        ]);
        
        return redirect()->route('intervencion.interviews')
            ->with('success', 'Entrevista completada con éxito.');
    }
    
    /**
     * Display tasks management.
     */
    public function tasks()
    {
        $user = Auth::user();
        $pendingTasks = $user->tasks()->whereIn('status', ['pendiente', 'en_progreso'])->orderBy('due_date')->get();
        $completedTasks = $user->tasks()->where('status', 'completada')->orderBy('completion_date', 'desc')->get();
        
        return view('pages.intervencion.tasks', compact('pendingTasks', 'completedTasks'));
    }
    
    /**
     * Create a new task.
     */
    public function storeTask(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:today',
        ]);
        
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pendiente';
        
        Task::create($validated);
        
        return redirect()->route('intervencion.tasks')
            ->with('success', 'Tarea creada con éxito.');
    }
    
    /**
     * Update task status.
     */
    public function updateTaskStatus(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        
        $validated = $request->validate([
            'status' => 'required|in:pendiente,en_progreso,completada,cancelada',
        ]);
        
        $task->update($validated);
        
        if ($validated['status'] == 'completada') {
            $task->update(['completion_date' => now()]);
        }
        
        return redirect()->route('intervencion.tasks')
            ->with('success', 'Estado de la tarea actualizado con éxito.');
    }
    
    /**
     * Display messaging configuration.
     */
    public function messaging()
    {
        $user = Auth::user();
        $telegramUsername = $user->profile->telegram_username;
        $messages = $user->messages()->orderBy('created_at', 'desc')->take(10)->get();
        
        return view('pages.intervencion.messaging', compact('telegramUsername', 'messages'));
    }
    
    /**
     * Configure Telegram messaging.
     */
    public function configureTelegram(Request $request)
    {
        $validated = $request->validate([
            'telegram_username' => 'required|string|max:255',
        ]);
        
        $user = Auth::user();
        
        if (!$user->profile) {
            $user->profile()->create(['telegram_username' => $validated['telegram_username']]);
        } else {
            $user->profile->update(['telegram_username' => $validated['telegram_username']]);
        }
        
        // Aquí se integraría con la API de Telegram para verificar el usuario
        // y configurar los mensajes diarios
        
        return redirect()->route('intervencion.messaging')
            ->with('success', 'Configuración de Telegram actualizada con éxito.');
    }
    
    /**
     * Send a test message via Telegram.
     */
    public function sendTestMessage()
    {
        $user = Auth::user();
        
        if (!$user->profile || !$user->profile->telegram_username) {
            return redirect()->route('intervencion.messaging')
                ->with('error', 'Primero debes configurar tu usuario de Telegram.');
        }
        
        // Crear mensaje en la base de datos
        $message = Message::create([
            'user_id' => $user->id,
            'message_type' => 'consejo',
            'content' => 'Este es un mensaje de prueba para verificar la configuración de Telegram.',
            'sent' => true,
            'sent_at' => now(),
        ]);
        
        // Aquí se integraría con la API de Telegram para enviar el mensaje
        
        return redirect()->route('intervencion.messaging')
            ->with('success', 'Mensaje de prueba enviado con éxito.');
    }
}
