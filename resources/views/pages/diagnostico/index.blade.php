@extends('layouts.app')

@section('title', 'Diagnóstico - Educación Alimentaria')

@section('styles')
<style>
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <h1 class="section-title">Diagnóstico Nutricional</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4"><i class="fas fa-chart-pie text-primary me-2"></i>Tu Diagnóstico Personalizado</h4>
                <p>Basado en los datos proporcionados en tu evaluación, hemos generado un diagnóstico personalizado de tu estado nutricional actual y tus conocimientos sobre alimentación saludable.</p>
                <p>Este diagnóstico te servirá como punto de partida para tu proceso de educación alimentaria y te ayudará a identificar áreas de mejora.</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Estado Nutricional</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6>Índice de Masa Corporal (IMC)</h6>
                            <div class="chart-container">
                                <canvas id="imcChart"></canvas>
                            </div>
                            <div class="alert alert-info">
                                <strong>Tu IMC:</strong> <span id="imcValue">24.8</span> - <span id="imcCategory">Peso Normal</span>
                            </div>
                            <p class="small text-muted">El IMC es una medida que relaciona tu peso y altura. Un IMC entre 18.5 y 24.9 se considera dentro del rango normal.</p>
                        </div>
                        
                        <div>
                            <h6>Riesgo Cardiovascular</h6>
                            <div class="progress mb-2" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">Bajo</div>
                            </div>
                            <p class="small text-muted">Basado en tu circunferencia de cintura y otros factores de riesgo.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Conocimientos Nutricionales</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="conocimientosChart"></canvas>
                        </div>
                        <div class="mt-3">
                            <h6>Áreas de Mejora:</h6>
                            <ul>
                                <li>Conocimiento sobre grupos de alimentos</li>
                                <li>Planificación de comidas</li>
                                <li>Lectura de etiquetas nutricionales</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Recomendaciones Personalizadas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-utensils fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Alimentación</h6>
                                <p>Aumenta el consumo de frutas y verduras a 5 porciones diarias.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-running fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Actividad Física</h6>
                                <p>Realiza al menos 30 minutos de actividad moderada 5 días a la semana.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-book fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Educación</h6>
                                <p>Revisa los módulos educativos sobre grupos de alimentos y etiquetado nutricional.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
            <a href="{{ url('/intervencion') }}" class="btn btn-primary">
                <i class="fas fa-arrow-right me-1"></i>Continuar a Intervención
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // IMC Chart
        const imcCtx = document.getElementById('imcChart').getContext('2d');
        const imcChart = new Chart(imcCtx, {
            type: 'bar',
            data: {
                labels: ['Bajo Peso', 'Normal', 'Sobrepeso', 'Obesidad'],
                datasets: [{
                    label: 'Rango de IMC',
                    data: [18.5, 24.9, 29.9, 40],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 40
                    }
                },
                plugins: {
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: 24.8,
                                yMax: 24.8,
                                borderColor: 'rgb(0, 0, 0)',
                                borderWidth: 2,
                            }
                        }
                    }
                }
            }
        });
        
        // Conocimientos Chart
        const conocimientosCtx = document.getElementById('conocimientosChart').getContext('2d');
        const conocimientosChart = new Chart(conocimientosCtx, {
            type: 'radar',
            data: {
                labels: [
                    'Conocimientos Básicos',
                    'Grupos de Alimentos',
                    'Planificación de Comidas',
                    'Etiquetado Nutricional',
                    'Hábitos Alimentarios',
                    'Actividad Física'
                ],
                datasets: [{
                    label: 'Tu Puntuación',
                    data: [70, 50, 40, 30, 60, 80],
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    pointBackgroundColor: 'rgb(75, 192, 192)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(75, 192, 192)'
                }, {
                    label: 'Puntuación Óptima',
                    data: [100, 100, 100, 100, 100, 100],
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                elements: {
                    line: {
                        borderWidth: 3
                    }
                },
                scales: {
                    r: {
                        angleLines: {
                            display: true
                        },
                        suggestedMin: 0,
                        suggestedMax: 100
                    }
                }
            }
        });
    });
</script>
@endsection
