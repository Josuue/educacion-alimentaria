@extends('layouts.app')

@section('title', 'Entrevista Motivacional')

@section('content')
<div class="container py-5">
    <div class="mx-auto" style="max-width: 900px; font-size: 1.1rem;">
        <h2 class="text-center mb-4">🎤 Entrevista Motivacional</h2>
        <p class="text-center text-muted mb-4">Aquí podrás programar tu entrevista, acceder al enlace de Zoom y registrar tus tareas de cambio.</p>

        <!-- Agenda de Entrevista -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Programar Entrevista</div>
            <div class="card-body">
                <form id="agenda-form">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" id="fecha" class="form-control" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <select id="hora" class="form-select">
                            <option selected disabled>Selecciona una hora</option>
                            <option>09:00</option>
                            <option>10:00</option>
                            <option>11:00</option>
                            <option>16:00</option>
                            <option>17:00</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Entrevista</button>
                </form>
                <div id="confirmacion-agenda" class="alert alert-success mt-3 d-none"></div>
            </div>
        </div>

        <!-- Zoom Call -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Videollamada por Zoom</div>
            <div class="card-body">
                <p>Tu entrevista se realizará mediante Zoom. Usa el botón de abajo para acceder a la sala.</p>
                <a href="https://zoom.us/j/1234567890" target="_blank" class="btn btn-primary">Unirse a la Entrevista</a>
            </div>
        </div>

        <!-- Tareas Personalizadas -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Tareas de Cambio</div>
            <div class="card-body">
                <form id="tareas-form">
                    <div class="mb-3">
                        <label for="tarea1" class="form-label">Tarea 1</label>
                        <input type="text" id="tarea1" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tarea2" class="form-label">Tarea 2</label>
                        <input type="text" id="tarea2" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tarea3" class="form-label">Tarea 3</label>
                        <input type="text" id="tarea3" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-secondary">Guardar Tareas</button>
                </form>
                <div id="confirmacion-tareas" class="alert alert-success mt-3 d-none"></div>
            </div>
        </div>

        <!-- Historial (estático) -->
        <div class="card mb-4">
            <div class="card-header bg-light">Historial de Entrevistas</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">🗓️ 12/04/2025 - 10:00 - Tema: Hidratación</li>
                    <li class="list-group-item">🗓️ 29/03/2025 - 11:00 - Tema: Azúcar y hábitos</li>
                    <li class="list-group-item">🗓️ 14/03/2025 - 16:00 - Tema: Organización de comidas</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('agenda-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const fecha = document.getElementById('fecha').value;
        const hora = document.getElementById('hora').value;
        const mensaje = document.getElementById('confirmacion-agenda');

        if (fecha && hora) {
            mensaje.textContent = `✅ Entrevista programada para el ${fecha} a las ${hora}.`;
            mensaje.classList.remove('d-none');
        }
    });

    document.getElementById('tareas-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const t1 = document.getElementById('tarea1').value;
        const t2 = document.getElementById('tarea2').value;
        const t3 = document.getElementById('tarea3').value;
        const mensaje = document.getElementById('confirmacion-tareas');

        if (t1 || t2 || t3) {
            mensaje.textContent = '✅ Tareas guardadas temporalmente. (No se guardan en BD)';
            mensaje.classList.remove('d-none');
        }
    });
</script>
@endsection
