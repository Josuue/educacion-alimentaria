@extends('layouts.app')

@section('content')
<style>
@media print {
    nav, header, footer, button {
        display: none !important;
    }

    body {
        padding: 30px;
        font-size: 14px;
        color: #000;
    }

    .text-right {
        text-align: right !important;
    }

    table {
        width: 100% !important;
    }
}
</style>

<div class="max-w-4xl mx-auto py-12 px-4 bg-white shadow-md rounded-lg">
    <h1 class="text-4xl font-extrabold mb-6 text-green-700 text-center">🩺 Informe de Diagnóstico Nutricional</h1>

    @if($ultima && $ultima->diagnosis)
        <div class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <p class="text-lg">👤 <strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                <p class="text-lg">📅 <strong>Fecha de evaluación:</strong> {{ $ultima->evaluation_date->format('d/m/Y') }}</p>
                <p class="text-lg">🧑‍⚕️ <strong>Nutricionista:</strong> ________________________</p>
            </div>
        </div>

        <div class="overflow-x-auto mt-6">
            <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">📈 Indicadores Diagnósticos</h2>
            <table class="w-full border border-gray-300 rounded-lg shadow-md text-sm">
                <thead class="bg-green-100 text-green-900">
                    <tr>
                        <th class="px-6 py-3 border-b text-left">Indicador</th>
                        <th class="px-6 py-3 border-b text-left">Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="px-6 py-3 border-t">Complexión</td><td class="px-6 py-3 border-t">{{ $ultima->complexion }}</td></tr>
                    <tr><td class="px-6 py-3 border-t">Peso ideal</td><td class="px-6 py-3 border-t">{{ $ultima->peso_ideal }}</td></tr>
                    <tr><td class="px-6 py-3 border-t">% Peso ideal</td><td class="px-6 py-3 border-t">{{ $ultima->porcentaje_peso_ideal }}</td></tr>
                    <tr><td class="px-6 py-3 border-t">% Peso habitual</td><td class="px-6 py-3 border-t">{{ $ultima->porcentaje_peso_habitual }}</td></tr>
                    <tr><td class="px-6 py-3 border-t">% Cambio reciente de peso</td><td class="px-6 py-3 border-t">{{ $ultima->porcentaje_cambio_peso }}</td></tr>
                    <tr><td class="px-6 py-3 border-t">% Pliegue tríceps</td><td class="px-6 py-3 border-t">{{ $ultima->porcentaje_pliegue_triceps }}</td></tr>
                    <tr><td class="px-6 py-3 border-t">Circunferencia muscular brazo</td><td class="px-6 py-3 border-t">{{ $ultima->circunferencia_muscular_brazo }}</td></tr>

                    <tr><td class="px-6 py-3 border-t">Área muscular brazo</td><td class="px-6 py-3 border-t">{{ $ultima->area_muscular_brazo }}</td></tr>

                    <tr>
                    <td class="px-6 py-3 border-t">Índice de masa corporal</td>
                    <td class="px-6 py-3 border-t">{{ $ultima->indice_masa_corporal }}</td></tr>

                    <tr><td class="px-6 py-3 border-t">Área superficie corporal</td><td class="px-6 py-3 border-t">{{ $ultima->area_superficie_corporal }}</td></tr>
                    <tr><td class="px-6 py-3 border-t">Peso corporal magro</td><td class="px-6 py-3 border-t">{{ $ultima->peso_corporal_magro }}</td></tr>
                    <tr><td class="px-6 py-3 border-t">Índice cintura-estatura</td><td class="px-6 py-3 border-t">{{ $ultima->indice_cintura_estatura }}</td></tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 text-right">
            <button onclick="window.print()" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                🖨️ Imprimir informe
            </button>
        </div>
    @else
        <p class="text-red-600 text-center text-lg font-semibold">No hay evaluación con diagnóstico disponible.</p>
    @endif
</div>
@endsection
