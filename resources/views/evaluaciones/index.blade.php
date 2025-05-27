@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Mis Evaluaciones</h1>

    @if($evaluaciones->isEmpty())
        <p class="text-gray-600">Aún no has registrado ninguna evaluación.</p>
    @else
        <table class="w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Peso (kg)</th>
                    <th class="px-4 py-2">Talla (cm)</th>
                    <th class="px-4 py-2">IMC</th>
                    <th class="px-4 py-2">IMC guardado</th>

                </tr>
            </thead>
            <tbody>
                @foreach($evaluaciones as $eval)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($eval->evaluation_date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ $eval->weight }}</td>
                        <td class="px-4 py-2">{{ $eval->height }}</td>
                        <td class="px-4 py-2">
                        <td class="px-4 py-2">{{ $eval->bmi }}</td>

                            @php
                                $altura_m = $eval->height / 100;
                                $imc = round($eval->weight / ($altura_m * $altura_m), 2);
                            @endphp
                            {{ $imc }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
