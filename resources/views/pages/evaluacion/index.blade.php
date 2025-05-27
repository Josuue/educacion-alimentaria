@extends('layouts.app')

@section('title', 'Evaluación - Educación Alimentaria')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <h1 class="section-title">Evaluación Inicial</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4"><i class="fas fa-info-circle text-primary me-2"></i>¿Qué es la evaluación?</h4>
                <p>La evaluación es el primer paso en tu proceso de educación alimentaria. Aquí recopilaremos información importante sobre tu estado actual, incluyendo datos antropométricos y conocimientos sobre nutrición.</p>
                <p>Esta información nos permitirá generar un diagnóstico personalizado y recomendaciones adaptadas a tus necesidades específicas.</p>
            </div>
        </div>

        <ul class="nav nav-tabs mb-4" id="evaluationTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos" type="button" role="tab" aria-controls="datos" aria-selected="true">
                    <i class="fas fa-user-edit me-1"></i>Datos Antropométricos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="conocimientos-tab" data-bs-toggle="tab" data-bs-target="#conocimientos" type="button" role="tab" aria-controls="conocimientos" aria-selected="false">
                    <i class="fas fa-brain me-1"></i>Prueba de Conocimientos
                </button>
            </li>
        </ul>
        
        <div class="tab-content" id="evaluationTabContent">
            <!-- Datos Antropométricos -->
            <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Datos Antropométricos</h4>
                        <form id="antropometricosForm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="edad" class="form-label">Edad (años)</label>
                                        <input type="number" class="form-control" id="edad" name="edad" min="1" max="120" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="genero" class="form-label">Género</label>
                                        <select class="form-select" id="genero" name="genero" required>
                                            <option value="" selected disabled>Selecciona una opción</option>
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="peso" class="form-label">Peso (kg)</label>
                                        <input type="number" class="form-control" id="peso" name="peso" step="0.1" min="1" max="300" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="altura" class="form-label">Altura (cm)</label>
                                        <input type="number" class="form-control" id="altura" name="altura" step="0.1" min="50" max="250" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="cintura" class="form-label">Circunferencia de cintura (cm)</label>
                                        <input type="number" class="form-control" id="cintura" name="cintura" step="0.1" min="40" max="200">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="actividad" class="form-label">Nivel de actividad física</label>
                                        <select class="form-select" id="actividad" name="actividad" required>
                                            <option value="" selected disabled>Selecciona una opción</option>
                                            <option value="sedentario">Sedentario (poco o nada de ejercicio)</option>
                                            <option value="ligero">Ligero (ejercicio 1-3 días/semana)</option>
                                            <option value="moderado">Moderado (ejercicio 3-5 días/semana)</option>
                                            <option value="intenso">Intenso (ejercicio 6-7 días/semana)</option>
                                            <option value="muy_intenso">Muy intenso (ejercicio diario intenso)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="objetivos" class="form-label">Objetivos personales</label>
                                <textarea class="form-control" id="objetivos" name="objetivos" rows="3" placeholder="Describe tus objetivos relacionados con la alimentación y la salud"></textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Guardar y Continuar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Prueba de Conocimientos -->
            <div class="tab-pane fade" id="conocimientos" role="tabpanel" aria-labelledby="conocimientos-tab">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Prueba de Conocimientos, Actitudes y Prácticas</h4>
                        <p class="mb-4">Esta prueba nos ayudará a evaluar tu nivel actual de conocimientos sobre alimentación saludable. No te preocupes si no conoces todas las respuestas, ¡estamos aquí para aprender juntos!</p>
                        
                        <form id="conocimientosForm">
                            <div class="mb-4">
                                <h5>Conocimientos Básicos</h5>
                                
                                <div class="mb-3">
                                    <label class="form-label">1. ¿Cuáles son los principales grupos de alimentos?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pregunta1" id="p1r1" value="1">
                                        <label class="form-check-label" for="p1r1">
                                            Carnes, lácteos y frutas
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pregunta1" id="p1r2" value="2">
                                        <label class="form-check-label" for="p1r2">
                                            Proteínas, carbohidratos y grasas
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pregunta1" id="p1r3" value="3">
                                        <label class="form-check-label" for="p1r3">
                                            Frutas, verduras, cereales, proteínas y lácteos
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">2. ¿Qué es el índice de masa corporal (IMC)?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pregunta2" id="p2r1" value="1">
                                        <label class="form-check-label" for="p2r1">
                                            Una medida de la grasa corporal
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pregunta2" id="p2r2" value="2">
                                        <label class="form-check-label" for="p2r2">
                                            Una relación entre el peso y la altura
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pregunta2" id="p2r3" value="3">
                                        <label class="form-check-label" for="p2r3">
                                            Un indicador del metabolismo basal
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h5>Actitudes hacia la Alimentación</h5>
                                
                                <div class="mb-3">
                                    <label class="form-label">3. ¿Con qué frecuencia planificas tus comidas con anticipación?</label>
                                    <select class="form-select" name="pregunta3" required>
                                        <option value="" selected disabled>Selecciona una opción</option>
                                        <option value="1">Nunca</option>
                                        <option value="2">Raramente</option>
                                        <option value="3">A veces</option>
                                        <option value="4">Frecuentemente</option>
                                        <option value="5">Siempre</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">4. ¿Qué tan importante consideras leer las etiquetas nutricionales?</label>
                                    <select class="form-select" name="pregunta4" required>
                                        <option value="" selected disabled>Selecciona una opción</option>
                                        <option value="1">Nada importante</option>
                                        <option value="2">Poco importante</option>
                                        <option value="3">Moderadamente importante</option>
                                        <option value="4">Importante</option>
                                        <option value="5">Muy importante</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h5>Prácticas Alimentarias</h5>
                                
                                <div class="mb-3">
                                    <label class="form-label">5. ¿Cuántas porciones de frutas y verduras consumes diariamente?</label>
                                    <select class="form-select" name="pregunta5" required>
                                        <option value="" selected disabled>Selecciona una opción</option>
                                        <option value="1">Ninguna</option>
                                        <option value="2">1-2 porciones</option>
                                        <option value="3">3-4 porciones</option>
                                        <option value="4">5 o más porciones</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">6. ¿Con qué frecuencia consumes comida rápida o procesada?</label>
                                    <select class="form-select" name="pregunta6" required>
                                        <option value="" selected disabled>Selecciona una opción</option>
                                        <option value="5">Nunca</option>
                                        <option value="4">Menos de una vez por semana</option>
                                        <option value="3">1-2 veces por semana</option>
                                        <option value="2">3-4 veces por semana</option>
                                        <option value="1">5 o más veces por semana</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle me-1"></i>Completar Evaluación
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Formulario de datos antropométricos
        const antropometricosForm = document.getElementById('antropometricosForm');
        if (antropometricosForm) {
            antropometricosForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Aquí iría la lógica para enviar los datos al servidor
                // Por ahora, solo cambiamos a la pestaña de conocimientos
                document.getElementById('conocimientos-tab').click();
            });
        }
        
        // Formulario de conocimientos
        const conocimientosForm = document.getElementById('conocimientosForm');
        if (conocimientosForm) {
            conocimientosForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Aquí iría la lógica para enviar los datos al servidor
                // Por ahora, redirigimos a la página de diagnóstico
                window.location.href = '/diagnostico';
            });
        }
    });
</script>
@endsection
