<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RouteController extends Controller
{
    /**
     * Actualizar las rutas de la aplicación para integrar frontend y backend
     */
    public function updateRoutes()
    {
        // Verificar que todas las rutas estén correctamente configuradas
        $routes = Route::getRoutes();
        $routeList = [];
        
        foreach ($routes as $route) {
            if (strpos($route->uri, '_') !== 0) { // Excluir rutas internas
                $routeList[] = [
                    'method' => implode('|', $route->methods),
                    'uri' => $route->uri,
                    'name' => $route->getName(),
                    'action' => $route->getActionName(),
                ];
            }
        }
        
        return view('integration.routes', compact('routeList'));
    }
    
    /**
     * Verificar la integración entre frontend y backend
     */
    public function checkIntegration()
    {
        // Verificar conexión a la base de datos
        try {
            \DB::connection()->getPdo();
            $dbConnection = true;
            $dbName = \DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
            $dbConnection = false;
            $dbName = null;
        }
        
        // Verificar migraciones
        $migrations = \DB::table('migrations')->get();
        
        // Verificar modelos
        $models = [
            'User' => class_exists('App\Models\User'),
            'Profile' => class_exists('App\Models\Profile'),
            'Evaluation' => class_exists('App\Models\Evaluation'),
            'Diagnosis' => class_exists('App\Models\Diagnosis'),
            'Task' => class_exists('App\Models\Task'),
            'EducationalContent' => class_exists('App\Models\EducationalContent'),
            'Interview' => class_exists('App\Models\Interview'),
            'Message' => class_exists('App\Models\Message'),
            'Payment' => class_exists('App\Models\Payment'),
        ];
        
        // Verificar controladores
        $controllers = [
            'EvaluationController' => class_exists('App\Http\Controllers\EvaluationController'),
            'DiagnosisController' => class_exists('App\Http\Controllers\DiagnosisController'),
            'InterventionController' => class_exists('App\Http\Controllers\InterventionController'),
            'MonitoringController' => class_exists('App\Http\Controllers\MonitoringController'),
            'TelegramController' => class_exists('App\Http\Controllers\TelegramController'),
        ];
        
        // Verificar vistas
        $views = [
            'welcome' => view()->exists('welcome'),
            'layouts.app' => view()->exists('layouts.app'),
            'layouts.navigation' => view()->exists('layouts.navigation'),
            'pages.evaluacion.index' => view()->exists('pages.evaluacion.index'),
            'pages.diagnostico.index' => view()->exists('pages.diagnostico.index'),
            'pages.intervencion.index' => view()->exists('pages.intervencion.index'),
            'pages.monitoreo.index' => view()->exists('pages.monitoreo.index'),
        ];
        
        return view('integration.check', compact('dbConnection', 'dbName', 'migrations', 'models', 'controllers', 'views'));
    }
}
