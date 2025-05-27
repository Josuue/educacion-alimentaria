<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    /**
     * Configuración de la integración con Telegram
     */
    public function configure(Request $request)
    {
        $validated = $request->validate([
            'telegram_username' => 'required|string|max:255',
            'message_frequency' => 'required|in:1,2,3',
            'message_types' => 'required|array',
        ]);
        
        $user = Auth::user();
        
        if (!$user->profile) {
            $user->profile()->create([
                'telegram_username' => $validated['telegram_username'],
            ]);
        } else {
            $user->profile->update([
                'telegram_username' => $validated['telegram_username'],
            ]);
        }
        
        // Guardar preferencias de mensajes en la sesión o en una tabla adicional
        session([
            'message_frequency' => $validated['message_frequency'],
            'message_types' => $validated['message_types'],
        ]);
        
        // Aquí se integraría con la API de Telegram
        // En un entorno real, se utilizaría un bot de Telegram y su API
        
        return redirect()->route('intervencion.messaging')
            ->with('success', 'Configuración de Telegram actualizada con éxito.');
    }
    
    /**
     * Enviar mensaje de prueba a través de Telegram
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
        
        // Simulación de envío a Telegram (en un entorno real se usaría la API de Telegram)
        try {
            // Aquí iría la integración real con la API de Telegram
            // Por ejemplo:
            // $response = Http::post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage', [
            //     'chat_id' => '@' . $user->profile->telegram_username,
            //     'text' => $message->content,
            // ]);
            
            // Simulamos una respuesta exitosa
            Log::info('Mensaje de prueba enviado a Telegram para el usuario: ' . $user->profile->telegram_username);
            
            return redirect()->route('intervencion.messaging')
                ->with('success', 'Mensaje de prueba enviado con éxito a @' . $user->profile->telegram_username);
        } catch (\Exception $e) {
            Log::error('Error al enviar mensaje a Telegram: ' . $e->getMessage());
            
            return redirect()->route('intervencion.messaging')
                ->with('error', 'Error al enviar mensaje: ' . $e->getMessage());
        }
    }
    
    /**
     * Programar mensajes diarios para todos los usuarios
     * Este método sería llamado por un cron job
     */
    public function scheduleMessages()
    {
        // Obtener usuarios con Telegram configurado
        $users = \App\Models\User::whereHas('profile', function($query) {
            $query->whereNotNull('telegram_username');
        })->get();
        
        foreach ($users as $user) {
            // Determinar tipo de mensaje a enviar (rotación entre tipos)
            $messageTypes = ['recordatorio', 'consejo', 'motivacion'];
            $messageType = $messageTypes[array_rand($messageTypes)];
            
            // Generar contenido según el tipo
            $content = $this->generateMessageContent($messageType, $user);
            
            // Crear mensaje en la base de datos
            $message = Message::create([
                'user_id' => $user->id,
                'message_type' => $messageType,
                'content' => $content,
                'sent' => false,
            ]);
        }
        
        return response()->json(['success' => true, 'message' => 'Mensajes programados con éxito']);
    }
    
    /**
     * Enviar mensajes programados
     * Este método sería llamado por un cron job
     */
    public function sendScheduledMessages()
    {
        $messages = Message::where('sent', false)->get();
        
        foreach ($messages as $message) {
            $user = $message->user;
            
            if (!$user->profile || !$user->profile->telegram_username) {
                continue;
            }
            
            try {
                // Aquí iría la integración real con la API de Telegram
                // Por ejemplo:
                // $response = Http::post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage', [
                //     'chat_id' => '@' . $user->profile->telegram_username,
                //     'text' => $message->content,
                // ]);
                
                // Simulamos una respuesta exitosa
                Log::info('Mensaje enviado a Telegram para el usuario: ' . $user->profile->telegram_username);
                
                // Actualizar estado del mensaje
                $message->update([
                    'sent' => true,
                    'sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                Log::error('Error al enviar mensaje a Telegram: ' . $e->getMessage());
            }
        }
        
        return response()->json(['success' => true, 'message' => 'Mensajes enviados con éxito']);
    }
    
    /**
     * Generar contenido de mensaje según el tipo
     */
    private function generateMessageContent($type, $user)
    {
        switch ($type) {
            case 'recordatorio':
                // Verificar si hay tareas pendientes
                $pendingTasks = $user->tasks()->where('status', 'pendiente')->count();
                if ($pendingTasks > 0) {
                    return "Recuerda que tienes {$pendingTasks} tareas pendientes. ¡Completa al menos una hoy!";
                } else {
                    return "¡Buen trabajo! Has completado todas tus tareas asignadas. Sigue así.";
                }
                break;
                
            case 'consejo':
                $consejos = [
                    "Bebe al menos 8 vasos de agua al día para mantenerte hidratado.",
                    "Incluye al menos 5 porciones de frutas y verduras en tu alimentación diaria.",
                    "Lee las etiquetas nutricionales para tomar decisiones informadas sobre los alimentos.",
                    "Limita el consumo de alimentos ultraprocesados y prefiere alimentos naturales.",
                    "Planifica tus comidas semanalmente para mantener una alimentación equilibrada.",
                ];
                return $consejos[array_rand($consejos)];
                break;
                
            case 'motivacion':
                $motivaciones = [
                    "Cada pequeño cambio en tus hábitos alimentarios suma. ¡Sigue adelante!",
                    "El camino hacia una alimentación saludable es un maratón, no una carrera. Avanza a tu ritmo.",
                    "Celebra tus logros, por pequeños que sean. Cada paso cuenta.",
                    "La constancia es clave para el éxito. Mantén el compromiso con tu salud.",
                    "Recuerda por qué empezaste este camino. Tu salud y bienestar merecen este esfuerzo.",
                ];
                return $motivaciones[array_rand($motivaciones)];
                break;
                
            default:
                return "Mensaje diario de Educación Alimentaria. ¡Que tengas un excelente día!";
        }
    }
}
