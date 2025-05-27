@extends('layouts.app')

@section('title', 'Inicio - Educación Alimentaria')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mb-4">
            <div class="card-body text-center py-5">
                <h1 class="display-4 text-primary mb-4">Plataforma Web para la Promoción de la Educación Alimentaria</h1>
                <p class="lead">Un espacio interactivo para mejorar tus hábitos alimentarios a través de la educación nutricional</p>
                <hr class="my-4">
                <p>Evalúa tu estado nutricional, recibe diagnósticos personalizados, accede a contenido educativo y participa en entrevistas motivacionales.</p>
                <div class="mt-4">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-user-plus me-2"></i>Registrarse
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </a>
                    @else
                        <a href="{{ url('/evaluacion') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-clipboard-list me-2"></i>Comenzar Evaluación
                        </a>
                    @endguest
                </div>
            </div>
        </div>

        <h2 class="section-title">¿Cómo funciona nuestra plataforma?</h2>

        <div class="row mb-5">
            <div class="col-md-3 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                        </div>
                        <h4 class="card-title">Evaluación</h4>
                        <p class="card-text">Ingresa tus datos antropométricos y realiza pruebas de conocimientos sobre alimentación.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-chart-pie fa-2x text-primary"></i>
                        </div>
                        <h4 class="card-title">Diagnóstico</h4>
                        <p class="card-text">Recibe un análisis automático con gráficos de tu estado nutricional.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-book-medical fa-2x text-primary"></i>
                        </div>
                        <h4 class="card-title">Intervención</h4>
                        <p class="card-text">Accede a contenido educativo, entrevistas motivacionales y recibe mensajes diarios.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-chart-line fa-2x text-primary"></i>
                        </div>
                        <h4 class="card-title">Monitoreo</h4>
                        <p class="card-text">Visualiza tu progreso y mejora continua con métricas personalizadas.</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="section-title">Características Destacadas</h2>

        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4><i class="fas fa-video text-primary me-2"></i>Entrevistas Motivacionales</h4>
                        <p>Participa en sesiones de videoconferencia con profesionales que te ayudarán a establecer metas realistas y mantener la motivación.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4><i class="fas fa-robot text-primary me-2"></i>Mensajería Diaria</h4>
                        <p>Recibe mensajes personalizados a través de Telegram para reforzar tus conocimientos y mantener el compromiso con tus objetivos.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4><i class="fas fa-tasks text-primary me-2"></i>Tareas Personalizadas</h4>
                        <p>Obtén tareas específicas adaptadas a tu nivel de interés y capacidad después de cada entrevista motivacional.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4><i class="fas fa-chart-bar text-primary me-2"></i>Seguimiento Visual</h4>
                        <p>Visualiza tu progreso con gráficos interactivos que muestran la evolución de tus métricas y conocimientos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

