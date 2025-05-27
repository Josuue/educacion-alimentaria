@extends('layouts.app')

@section('title', 'Intervención - Educación Alimentaria')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <h1 class="section-title">Intervención Educativa</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4"><i class="fas fa-book-medical text-primary me-2"></i>Tu Plan de Intervención</h4>
                <p>Basado en tu evaluación y diagnóstico, hemos diseñado un plan de intervención personalizado para mejorar tus conocimientos y hábitos alimentarios.</p>
                <p>Esta sección incluye contenido educativo, entrevistas motivacionales y un sistema de mensajería diaria para ayudarte a mantener el compromiso con tus objetivos.</p>
            </div>
        </div>

        <ul class="nav nav-tabs mb-4" id="intervencionTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="educacion-tab" data-bs-toggle="tab" data-bs-target="#educacion" type="button" role="tab" aria-controls="educacion" aria-selected="true">
                    <i class="fas fa-graduation-cap me-1"></i>Contenido Educativo
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="entrevistas-tab" data-bs-toggle="tab" data-bs-target="#entrevistas" type="button" role="tab" aria-controls="entrevistas" aria-selected="false">
                    <i class="fas fa-video me-1"></i>Entrevistas Motivacionales
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tareas-tab" data-bs-toggle="tab" data-bs-target="#tareas" type="button" role="tab" aria-controls="tareas" aria-selected="false">
                    <i class="fas fa-tasks me-1"></i>Tareas Asignadas
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="mensajes-tab" data-bs-toggle="tab" data-bs-target="#mensajes" type="button" role="tab" aria-controls="mensajes" aria-selected="false">
                    <i class="fas fa-comment-dots me-1"></i>Mensajería Diaria
                </button>
            </li>
        </ul>
        
        <div class="tab-content" id="intervencionTabContent">
            <!-- Contenido Educativo -->
            <div class="tab-pane fade show active" id="educacion" role="tabpanel" aria-labelledby="educacion-tab">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Módulos Educativos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="https://via.placeholder.com/300x150?text=Grupos+de+Alimentos" class="card-img-top" alt="Grupos de Alimentos">
                                    <div class="card-body">
                                        <h5 class="card-title">Grupos de Alimentos</h5>
                                        <p class="card-text">Aprende sobre los diferentes grupos de alimentos y su importancia en una dieta equilibrada.</p>
                                        <a href="#" class="btn btn-primary btn-sm">Ver Módulo</a>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <small class="text-muted"><i class="fas fa-clock me-1"></i>Duración: 20 minutos</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="https://via.placeholder.com/300x150?text=Etiquetado+Nutricional" class="card-img-top" alt="Etiquetado Nutricional">
                                    <div class="card-body">
                                        <h5 class="card-title">Etiquetado Nutricional</h5>
                                        <p class="card-text">Aprende a interpretar las etiquetas de los alimentos para tomar decisiones informadas.</p>
                                        <a href="#" class="btn btn-primary btn-sm">Ver Módulo</a>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <small class="text-muted"><i class="fas fa-clock me-1"></i>Duración: 15 minutos</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="https://via.placeholder.com/300x150?text=Planificación+de+Comidas" class="card-img-top" alt="Planificación de Comidas">
                                    <div class="card-body">
                                        <h5 class="card-title">Planificación de Comidas</h5>
                                        <p class="card-text">Estrategias para planificar tus comidas de manera saludable y económica.</p>
                                        <a href="#" class="btn btn-primary btn-sm">Ver Módulo</a>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <small class="text-muted"><i class="fas fa-clock me-1"></i>Duración: 25 minutos</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Recursos Descargables</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                    <span>Guía de Alimentación Saludable</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">PDF</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-image text-success me-2"></i>
                                    <span>Infografía: Plato Saludable</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">PNG</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-alt text-info me-2"></i>
                                    <span>Recetas Saludables</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">PDF</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Entrevistas Motivacionales -->
            <div class="tab-pane fade" id="entrevistas" role="tabpanel" aria-labelledby="entrevistas-tab">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Entrevistas Motivacionales con Jitsi Meet</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Las entrevistas motivacionales son sesiones personalizadas con un profesional que te ayudarán a establecer metas realistas y mantener la motivación en tu proceso de cambio de hábitos alimentarios.</p>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-calendar-alt text-primary me-2"></i>Programar Entrevista</h5>
                                        <p class="card-text">Selecciona una fecha y hora para tu próxima entrevista motivacional.</p>
                                        
                                        <form>
                                            <div class="mb-3">
                                                <label for="fechaEntrevista" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" id="fechaEntrevista" min="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="horaEntrevista" class="form-label">Hora</label>
                                                <select class="form-select" id="horaEntrevista">
                                                    <option value="" selected disabled>Selecciona una hora</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="18:00">18:00</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Programar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-video text-primary me-2"></i>Próxima Entrevista</h5>
                                        <div class="alert alert-info">
                                            <p class="mb-1"><strong>Fecha:</strong> No tienes entrevistas programadas</p>
                                        </div>
                                        <p class="card-text">Cuando tengas una entrevista programada, podrás unirte a la videoconferencia desde aquí.</p>
                                        <button class="btn btn-success" disabled>
                                            <i class="fas fa-video me-1"></i>Unirse a la Entrevista
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-history text-primary me-2"></i>Historial de Entrevistas</h5>
                                <p class="card-text">Aquí podrás ver el historial de tus entrevistas motivacionales anteriores.</p>
                                
                                <div class="alert alert-secondary">
                                    <p class="mb-0">No tienes entrevistas previas registradas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Área de videoconferencia Jitsi Meet -->
                <div class="card mb-4 d-none" id="jitsiContainer">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Entrevista en Curso</h5>
                        <button type="button" class="btn-close" aria-label="Close" id="closeJitsi"></button>
                    </div>
                    <div class="card-body p-0">
                        <div id="jitsiMeet" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
            
            <!-- Tareas Asignadas -->
            <div class="tab-pane fade" id="tareas" role="tabpanel" aria-labelledby="tareas-tab">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Tareas Personalizadas</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Después de cada entrevista motivacional, se te asignarán tareas específicas para ayudarte a alcanzar tus objetivos. Aquí podrás ver y gestionar tus tareas asignadas.</p>
                        
                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle me-2"></i>Aún no tienes tareas asignadas. Programa una entrevista motivacional para recibir tareas personalizadas.
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ejemplo de Tareas</h5>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Aumentar consumo de agua</h6>
                                            <p class="mb-0 small text-muted">Beber al menos 8 vasos de agua al día durante una semana.</p>
                                        </div>
                                        <span class="badge bg-secondary rounded-pill">Pendiente</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Reducir azúcares añadidos</h6>
                                            <p class="mb-0 small text-muted">Limitar el consumo de bebidas azucaradas a una vez por semana.</p>
                                        </div>
                                        <span class="badge bg-secondary rounded-pill">Pendiente</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Planificar comidas</h6>
                                            <p class="mb-0 small text-muted">Preparar un plan de comidas semanal incluyendo al menos 3 recetas nuevas.</p>
                                        </div>
                                        <span class="badge bg-secondary rounded-pill">Pendiente</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mensajería Diaria -->
            <div class="tab-pane fade" id="mensajes" role="tabpanel" aria-labelledby="mensajes-tab">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Mensajería Diaria vía Telegram</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">Recibe mensajes diarios personalizados a través de Telegram para reforzar tus conocimientos y mantener el compromiso con tus objetivos.</p>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fab fa-telegram text-primary me-2"></i>Configurar Telegram</h5>
                                        <p class="card-text">Para recibir mensajes diarios, necesitas vincular tu cuenta de Telegram.</p>
                                        
                                        <form>
                                            <div class="mb-3">
                                                <label for="telegramUser" class="form-label">Usuario de Telegram</label>
                                                <input type="text" class="form-control" id="telegramUser" placeholder="@usuario">
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-link me-1"></i>Vincular Cuenta
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-sliders-h text-primary me-2"></i>Preferencias de Mensajes</h5>
                                        <p class="card-text">Personaliza la frecuencia y el tipo de mensajes que deseas recibir.</p>
                                        
                                        <form>
                                            <div class="mb-3">
                                                <label for="frecuenciaMensajes" class="form-label">Frecuencia</label>
                                                <select class="form-select" id="frecuenciaMensajes">
                                                    <option value="1">Una vez al día</option>
                                                    <option value="2">Dos veces al día</option>
                                                    <option value="3">Tres veces al día</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tipo de Mensajes</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="tipoRecordatorios" checked>
                                                    <label class="form-check-label" for="tipoRecordatorios">
                                                        Recordatorios de tareas
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="tipoConsejos" checked>
                                                    <label class="form-check-label" for="tipoConsejos">
                                                        Consejos nutricionales
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="tipoMotivacion" checked>
                                                    <label class="form-check-label" for="tipoMotivacion">
                                                        Mensajes motivacionales
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar Preferencias</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-history text-primary me-2"></i>Historial de Mensajes</h5>
                                <p class="card-text">Aquí podrás ver los últimos mensajes enviados a tu cuenta de Telegram.</p>
                                
                                <div class="alert alert-secondary">
                                    <p class="mb-0">No hay mensajes registrados. Vincula tu cuenta de Telegram para comenzar a recibir mensajes diarios.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
            <a href="{{ url('/monitoreo') }}" class="btn btn-primary">
                <i class="fas fa-arrow-right me-1"></i>Continuar a Monitoreo
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://meet.jit.si/external_api.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ejemplo de inicialización de Jitsi Meet (se activaría al hacer clic en "Unirse a la Entrevista")
        const initJitsi = () => {
            const domain = 'meet.jit.si';
            const options = {
                roomName: 'educacionAlimentaria' + Math.random().toString(36).substring(2, 7),
                width: '100%',
                height: '100%',
                parentNode: document.querySelector('#jitsiMeet'),
                interfaceConfigOverwrite: {
                    TOOLBAR_BUTTONS: [
                        'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                        'fodeviceselection', 'hangup', 'profile', 'chat', 'recording',
                        'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
                        'videoquality', 'filmstrip', 'feedback', 'stats', 'shortcuts',
                        'tileview', 'videobackgroundblur', 'download', 'help', 'mute-everyone'
                    ],
                }
            };
            
            const api = new JitsiMeetExternalAPI(domain, options);
            
            // Evento para cerrar la videoconferencia
            document.getElementById('closeJitsi').addEventListener('click', () => {
                api.dispose();
                document.getElementById('jitsiContainer').classList.add('d-none');
            });
            
            return api;
        };
        
        // Este código es solo para demostración y se activaría al hacer clic en el botón "Unirse a la Entrevista"
        // const joinButton = document.querySelector('button.btn-success');
        // if (joinButton) {
        //     joinButton.addEventListener('click', () => {
        //         document.getElementById('jitsiContainer').classList.remove('d-none');
        //         initJitsi();
        //     });
        // }
    });
</script>
@endsection
