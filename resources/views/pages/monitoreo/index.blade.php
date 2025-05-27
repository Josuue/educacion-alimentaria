@extends('layouts.app')

@section('title', 'Monitoreo - Educación Alimentaria')

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
        <h1 class="section-title">Monitoreo de Progreso</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4"><i class="fas fa-chart-line text-primary me-2"></i>Tu Progreso</h4>
                <p>En esta sección podrás visualizar tu progreso a lo largo del tiempo, incluyendo cambios en medidas antropométricas, conocimientos adquiridos y cumplimiento de tareas asignadas.</p>
                <p>El monitoreo regular te ayudará a mantener la motivación y realizar ajustes en tu plan de intervención cuando sea necesario.</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Evolución de Medidas</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="medidasChart"></canvas>
                        </div>
                        <div class="mt-3">
                            <h6>Resumen:</h6>
                            <ul>
                                <li>IMC inicial: <strong>24.8</strong></li>
                                <li>IMC actual: <strong>24.5</strong></li>
                                <li>Cambio: <span class="text-success">-0.3</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Progreso en Conocimientos</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="conocimientosProgressChart"></canvas>
                        </div>
                        <div class="mt-3">
                            <h6>Áreas de Mayor Mejora:</h6>
                            <ul>
                                <li>Grupos de alimentos: <span class="text-success">+25%</span></li>
                                <li>Etiquetado nutricional: <span class="text-success">+15%</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Cumplimiento de Tareas</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="tareasChart"></canvas>
                        </div>
                        <div class="mt-3">
                            <h6>Estadísticas:</h6>
                            <ul>
                                <li>Tareas completadas: <strong>5</strong></li>
                                <li>Tareas pendientes: <strong>2</strong></li>
                                <li>Tasa de cumplimiento: <strong>71%</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Hábitos Alimentarios</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="habitosChart"></canvas>
                        </div>
                        <div class="mt-3">
                            <h6>Cambios Positivos:</h6>
                            <ul>
                                <li>Consumo de frutas y verduras: <span class="text-success">+2 porciones/día</span></li>
                                <li>Consumo de agua: <span class="text-success">+500 ml/día</span></li>
                                <li>Consumo de alimentos procesados: <span class="text-success">-30%</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Actualizar Medidas</h5>
            </div>
            <div class="card-body">
                <p class="mb-4">Para mantener un seguimiento preciso de tu progreso, actualiza regularmente tus medidas antropométricas.</p>
                
                <form id="actualizarMedidasForm">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="pesoActual" class="form-label">Peso actual (kg)</label>
                                <input type="number" class="form-control" id="pesoActual" name="pesoActual" step="0.1" min="1" max="300" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="cinturaActual" class="form-label">Circunferencia de cintura (cm)</label>
                                <input type="number" class="form-control" id="cinturaActual" name="cinturaActual" step="0.1" min="40" max="200">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="fechaMedida" class="form-label">Fecha de medición</label>
                                <input type="date" class="form-control" id="fechaMedida" name="fechaMedida" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar Medidas
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Método de Pago</h5>
            </div>
            <div class="card-body">
                <p class="mb-4">Para acceder a funcionalidades premium como entrevistas motivacionales ilimitadas y contenido educativo avanzado, puedes realizar un pago mediante transferencia bancaria o Bizum.</p>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-university text-primary me-2"></i>Transferencia Bancaria</h5>
                                <p class="card-text">Realiza una transferencia a la siguiente cuenta bancaria:</p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Banco:</strong> Banco Ejemplo</li>
                                    <li class="list-group-item"><strong>Titular:</strong> Educación Alimentaria S.L.</li>
                                    <li class="list-group-item"><strong>IBAN:</strong> ES12 3456 7890 1234 5678 9012</li>
                                    <li class="list-group-item"><strong>Concepto:</strong> Premium + [Tu Email]</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-mobile-alt text-primary me-2"></i>Bizum</h5>
                                <p class="card-text">Realiza un pago mediante Bizum al siguiente número:</p>
                                <div class="alert alert-info text-center">
                                    <h4 class="mb-0">600 123 456</h4>
                                </div>
                                <p class="card-text">Incluye en el concepto: <strong>Premium + [Tu Email]</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i>Una vez realizado el pago, recibirás un correo electrónico de confirmación en un plazo de 24 horas y se activarán automáticamente las funcionalidades premium en tu cuenta.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Medidas Chart
        const medidasCtx = document.getElementById('medidasChart').getContext('2d');
        const medidasChart = new Chart(medidasCtx, {
            type: 'line',
            data: {
                labels: ['Inicio', 'Semana 1', 'Semana 2', 'Semana 3', 'Actual'],
                datasets: [{
                    label: 'IMC',
                    data: [24.8, 24.7, 24.6, 24.5, 24.5],
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 23,
                        max: 26
                    }
                }
            }
        });
        
        // Conocimientos Progress Chart
        const conocimientosCtx = document.getElementById('conocimientosProgressChart').getContext('2d');
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
                    label: 'Inicial',
                    data: [70, 50, 40, 30, 60, 80],
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                }, {
                    label: 'Actual',
                    data: [75, 75, 50, 45, 65, 85],
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    pointBackgroundColor: 'rgb(54, 162, 235)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(54, 162, 235)'
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
        
        // Tareas Chart
        const tareasCtx = document.getElementById('tareasChart').getContext('2d');
        const tareasChart = new Chart(tareasCtx, {
            type: 'doughnut',
            data: {
                labels: ['Completadas', 'Pendientes'],
                datasets: [{
                    data: [5, 2],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        // Hábitos Chart
        const habitosCtx = document.getElementById('habitosChart').getContext('2d');
        const habitosChart = new Chart(habitosCtx, {
            type: 'bar',
            data: {
                labels: ['Frutas/Verduras', 'Agua', 'Procesados', 'Actividad Física'],
                datasets: [{
                    label: 'Inicial',
                    data: [2, 1.5, 5, 2],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Actual',
                    data: [4, 2, 3.5, 3],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Formulario de actualización de medidas
        const actualizarMedidasForm = document.getElementById('actualizarMedidasForm');
        if (actualizarMedidasForm) {
            actualizarMedidasForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Aquí iría la lógica para enviar los datos al servidor
                alert('Medidas actualizadas correctamente');
            });
        }
    });
</script>
@endsection
