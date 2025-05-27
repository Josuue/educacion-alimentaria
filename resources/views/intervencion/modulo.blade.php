@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-green-700 mb-6 text-center">
        📘 {{ $contenido['titulo'] }}
    </h1>

    <p class="mb-6 text-lg text-gray-700">{{ $contenido['descripcion'] }}</p>

    {{-- Video --}}
    <div class="mb-6">
        <iframe class="w-full aspect-video rounded shadow" src="{{ $contenido['video'] }}" frameborder="0" allowfullscreen></iframe>
    </div>

    {{-- PDF --}}
    <div class="mb-6 text-center">
        <a href="{{ $contenido['pdf'] }}" target="_blank"
           class="inline-block bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700">
            📄 Descargar Guía en PDF
        </a>
    </div>

    {{-- Botón completar --}}
    <div class="text-center mt-10">
        <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            ✅ Marcar como completado
        </button>
    </div>

    {{-- Volver --}}
    <div class="text-center mt-6">
        <a href="{{ route('intervencion') }}" class="text-green-700 hover:underline">← Volver a Intervención</a>
    </div>
</div>
@endsection
