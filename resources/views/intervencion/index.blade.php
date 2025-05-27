@extends('layouts.app')

@section('title', 'Educación Alimentaria - Intervención')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Educación Alimentaria</h1>
    <p class="text-center text-muted mb-5">Explora los módulos para mejorar tus conocimientos y hábitos alimentarios.</p>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach([
    [
        'titulo' => 'Hábitos de alimentación saludable y sostenible',
        'descripcion' => 'Aprende sobre buenos hábitos de consumo de alimentos',
        'video' => 'https://www.youtube.com/embed/Nwg8nAspbvc',
        'pdf' => 'https://www.aesan.gob.es/AECOSAN/docs/documentos/nutricion/RECOMENDACIONES_DIETETICAS.pdf',
        'test' => '/tests/grupos'
    ],
    [
        'titulo' => 'Actividad física',
        'descripcion' => 'Estrategias para planificar tus comidas de forma saludable y económica.',
        'video' => 'https://www.youtube.com/embed/e6h8zuEven0',
        'pdf' => 'https://plancuidatemas.aesan.gob.es/PLAN_CUIDATE/default.htm',
        'test' => '/tests/planificacion'
    ],
    [
        'titulo' => 'Lectura de Etiquetas',
        'descripcion' => 'Interpretar etiquetas te permite tomar decisiones informadas al comprar.',
        'video' => 'https://www.youtube.com/embed/fa38AWc1ZsM',
        'pdf' => 'https://eletiquetadocuentamucho.aesan.gob.es/index.html',
        'test' => '/tests/etiquetas'
    ],
    [
        'titulo' => 'Alchohol',
        'descripcion' => 'Adquiere rutinas saludables para mejorar tu bienestar.',
        'video' => 'https://www.youtube.com/embed/oG9MutPwsBU',
        'pdf' => 'https://estilosdevidasaludable.sanidad.gob.es/consumo/home.htm',
        'test' => '/tests/habitos'
    ],
    [
        'titulo' => 'Manipulación de alimentos',
        'descripcion' => 'Reducir azúcares añadidos te ayuda a prevenir enfermedades.',
        'video' => 'https://www.youtube.com/embed/gLk1gX7bQdo',
        'pdf' => 'https://www.aesan.gob.es/AECOSAN/web/para_el_consumidor/ampliacion/manipulacion_alimentos.htm',
        'test' => '/tests/azucar'
    ],
    [
        'titulo' => 'Estilos de vida saludable',
        'descripcion' => 'Descubre los beneficios de una buena hidratación.',
        'video' => 'https://www.youtube.com/embed/cccN0ADEGMA',
        'pdf' => '/docs/mas-agua.pdf',
        'test' => '/tests/agua'
    ]
] as $modulo)

        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                <h5 class="card-title">{{ $modulo['titulo'] }}</h5>

                {{-- VIDEO DE YOUTUBE --}}
                <div class="mb-3">
                    <iframe width="100%" height="200" src="{{ $modulo['video'] }}" frameborder="0" allowfullscreen></iframe>
                </div>

                {{-- DESCRIPCIÓN --}}
                <p class="card-text">{{ $modulo['descripcion'] }}</p>

                {{-- LECTURA --}}
                <a href="{{ $modulo['pdf'] }}" target="_blank" class="btn btn-outline-secondary btn-sm mt-2">
                    📖 Ver Lectura
                </a>

                {{-- TEST --}}

               <a href="{{ route('intervencion.test') }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2 ms-2">
                    📝 Realizar Test
               </a>


</div>

            </div>
        </div>
        @endforeach
    </div>
    </div> <!-- Cierre de row -->

<div class="text-center mt-5">
    <a href="{{ route('intervencion.entrevista') }}" class="btn btn-primary btn-lg me-3">
        🎤 Ir a la Entrevista Motivacional
    </a>

    <a href="https://wa.me/34600000000?text=Hola,%20me%20gustaría%20recibir%20acompañamiento%20nutricional"
       target="_blank" class="btn btn-success btn-lg">
        💬 Enviar mensaje por WhatsApp
    </a>
</div>

</div>
@endsection
