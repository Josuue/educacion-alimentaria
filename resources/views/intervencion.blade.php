@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-6">
    <h1 class="text-4xl font-bold text-center text-green-700 mb-10">🧩 Plan de Intervención Nutricional</h1>

    {{-- EDUCACIÓN ALIMENTARIA --}}
    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-green-600 mb-4">📚 Educación Alimentaria</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow p-6 border">
                <h3 class="text-lg font-bold mb-2">Grupos de alimentos</h3>
                    <p class="text-gray-700 mb-2">Aprende a identificar y combinar correctamente los alimentos.</p>

                    <a href="{{ route('intervencion.modulo', 'grupos-alimentos') }}"
                    class="inline-block bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700 transition">
                        Ver módulo
                    </a>
        </div>

            <div class="bg-white rounded-xl shadow p-6 border">
                <h3 class="text-lg font-bold mb-2">Planificación de comidas</h3>
                <p class="text-gray-700 mb-2">Organiza tus menús diarios de forma saludable y económica.</p>
                <button class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700 transition">Ver módulo</button>
            </div>
            <div class="bg-white rounded-xl shadow p-6 border">
                <h3 class="text-lg font-bold mb-2">Lectura de etiquetas</h3>
                <p class="text-gray-700 mb-2">Aprende a leer y entender etiquetas nutricionales.</p>
                <button class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700 transition">Ver módulo</button>
            </div>
        </div>
    </section>

    {{-- ENTREVISTA MOTIVACIONAL --}}
    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-green-600 mb-4">🗣️ Entrevista Motivacional</h2>
        <div class="bg-white rounded-xl shadow p-6 border space-y-4">
            <p class="text-gray-700">Aquí puedes asignar tareas, dejar observaciones y acompañar el proceso del paciente.</p>
            <textarea class="w-full border rounded p-3" rows="4" placeholder="Escribe observaciones o tareas aquí..."></textarea>
            <div class="text-right">
                <button class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700 transition">Guardar tarea</button>
            </div>
        </div>
    </section>

    {{-- REFUERZO POR WHATSAPP --}}
    <section>
        <h2 class="text-2xl font-semibold text-green-600 mb-4">📱 Refuerzo por WhatsApp</h2>
        <div class="bg-white rounded-xl shadow p-6 border space-y-4">
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600">
                <span class="text-gray-700">Activar recordatorios diarios por WhatsApp</span>
            </label>
            <p class="text-gray-600 italic">*Los mensajes se enviarán automáticamente con consejos personalizados.</p>
        </div>
    </section>

    {{-- Botón imprimir --}}
    <div class="mt-12 text-center">
        <button onclick="window.print()" class="bg-red-600 text-black px-6 py-3 rounded-xl font-bold hover:bg-red-700 transition">
            🖨️ Imprimir / Guardar como PDF
        </button>
    </div>
</div>

<style>
    @media print {
        nav, header, footer, button, .no-print {
            display: none !important;
        }
        body {
            padding: 20px;
        }
    }
</style>
@endsection
