@extends('layouts.app')

@section('content')

<header class="bg-green-600 text-black p-6 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div><h1 class="text-2xl font-bold">NutriHealth</h1></div>
        <div class="flex items-center space-x-4">
            <a href="/comprar" title="Carrito de compra">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 5.1a1 1 0 001 1.3h11a1 1 0 001-1.3L17 13M9 21h.01M15 21h.01"/>
                </svg>
            </a>
        </div>
    </div>
</header>

<nav class="bg-green-100 shadow-md">
    <ul class="max-w-7xl mx-auto flex justify-between px-10 py-4 text-lg font-semibold text-green-800">
        <li><a href="/" class="hover:underline">Inicio</a></li>
        <li><a href="/evaluacion" class="hover:underline">Evaluación</a></li>
        <li><a href="/diagnostico" class="hover:underline">Diagnóstico</a></li>
        <li><a href="/intervencion" class="hover:underline">Intervención</a></li>
        <li><a href="/monitoreo" class="hover:underline">Monitoreo</a></li>
        <li><a href="/profile" class="hover:underline">Mi Perfil</a></li>
        <li><a href="/contacto" class="hover:underline">Contacto</a></li>
    </ul>
</nav>

<style>
    @media print {
        form,
        nav,
        header,
        footer,
        button,
        .no-print {
            display: none !important;
        }

        body {
            padding: 20px;
        }
    }
</style>

<main class="max-w-4xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">Formulario de Evaluación</h2>

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('imc'))
        <div class="mb-4 bg-blue-100 border border-blue-300 text-blue-800 px-4 py-2 rounded">
            Tu IMC es: <strong>{{ session('imc') }}</strong>
        </div>
    @endif

    @if(session('edad'))
        <div class="mb-4 bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-2 rounded">
            Tu edad calculada es: <strong>{{ session('edad') }}</strong> años.
        </div>
    @endif

    {{-- Tabla resumen --}}

    @if(session('resumen'))
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold text-green-700 text-center mb-6">📝 Resumen de Evaluación</h2>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-green-100 text-green-900 text-left">
                <tr>
                    <th class="px-6 py-3 font-semibold border-b border-gray-300">Campo</th>
                    <th class="px-6 py-3 font-semibold border-b border-gray-300">Valor</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $labels = [
                        'weight' => 'Peso (kg)',
                        'usual_weight' => 'Peso usual (kg)',
                        'height' => 'Talla (cm)',
                        'waist_circumference' => 'Circunferencia abdominal (cm)',
                        'hip_circumference' => 'Circunferencia de la cadera (cm)',
                        'wrist_circumference' => 'Circunferencia de la muñeca (cm)',
                        'arm_circumference' => 'Perímetro braquial (cm)',
                        'triceps_skinfold' => 'Pliegue cutáneo del tríceps (mm)',
                        'activity_level' => 'Nivel de actividad física',
                        'birth_date' => 'Fecha de nacimiento',
                        'edad' => 'Edad',
                        'bmi' => 'Índice de Masa Corporal (IMC)',
                        'evaluation_date' => 'Fecha de evaluación',
                        'sexo' => 'Sexo',
                        'complexion' => 'Complexión',
                    ];
                    $resumen = session('resumen');
                    if (session('edad')) {
                        $resumen['edad'] = session('edad');
                    }
                    if (session('imc')) {
                        $resumen['bmi'] = session('imc');
                    }
                @endphp

                @foreach($labels as $campo => $etiqueta)
                    @if(isset($resumen[$campo]))
                        <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="px-6 py-3 border-t border-gray-200 text-gray-700 font-medium">
                                {{ $etiqueta }}
                            </td>
                            <td class="px-6 py-3 border-t border-gray-200 text-gray-900">
                                {{ $resumen[$campo] }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Botón para imprimir --}}
    <div class="text-right mt-6">
        <button onclick="window.print()" class="bg-green-600 text-red px-6 py-2 rounded hover:bg-green-700 transition">
            🖨️ Imprimir / Guardar como PDF
        </button>
    </div>
</div>
    @endif






    {{-- Formulario --}}
    <form action="{{ route('evaluacion.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-6 mt-10">
        @csrf

        {{-- Fila: Fecha de nacimiento --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold">Fecha de nacimiento:</label>
                <input type="date" name="birth_date" class="w-full max-w-xs border rounded p-2">
            </div>
        </div>

        {{-- Fila: Sexo + Actividad física --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold">Sexo:</label>
                <select name="sexo" class="w-full max-w-xs border rounded p-2" required>
                    <option value="">Selecciona</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold">Nivel de actividad física:</label>
                <select name="activity_level" class="w-full max-w-xs border rounded p-2">
                    <option value="">Selecciona</option>
                    <option value="sedentario">Sedentario</option>
                    <option value="ligero">Ligero</option>
                    <option value="moderado">Moderado</option>
                    <option value="intenso">Intenso</option>
                </select>
            </div>
        </div>

        {{-- Fila: Peso actual + Peso usual --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold">Peso actual (kg):</label>
                <input type="number" step="0.01" name="weight" class="w-full max-w-xs border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold">Peso usual (kg):</label>
                <input type="number" step="0.01" name="usual_weight" class="w-full max-w-xs border rounded p-2">
            </div>
        </div>

        {{-- Fila: Talla + Circ. abdominal --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold">Talla (cm):</label>
                <input type="number" step="0.1" name="height" class="w-full max-w-xs border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold">Circunferencia abdominal (cm):</label>
                <input type="number" step="0.1" name="waist_circumference" class="w-full max-w-xs border rounded p-2">
            </div>
        </div>

        {{-- Fila: Cadera + Muñeca --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold">Circunferencia de la cadera (cm):</label>
                <input type="number" step="0.1" name="hip_circumference" class="w-full max-w-xs border rounded p-2">
            </div>
            <div>
                <label class="block font-semibold">Circunferencia de la muñeca (cm):</label>
                <input type="number" step="0.1" name="wrist_circumference" class="w-full max-w-xs border rounded p-2">
            </div>
        </div>

        {{-- Fila: PCT + Braquial --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold">Pliegue cutáneo del tríceps (PCT) (mm):</label>
                <input type="number" step="0.1" name="triceps_skinfold" class="w-full max-w-xs border rounded p-2">
            </div>
            <div>
                <label class="block font-semibold">Perímetro braquial (cm):</label>
                <input type="number" step="0.1" name="arm_circumference" class="w-full max-w-xs border rounded p-2">
            </div>
        </div>

        {{-- Botón --}}
        <div class="text-right pt-4">
            <button type="submit" class="bg-red-500 text-black px-6 py-3 rounded font-bold hover:bg-red-600 transition">
                 Enviar evaluación
            </button>
        </div>
    </form>
</main>

@endsection
