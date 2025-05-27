@extends('layouts.app')

@section('title', 'Test: Estilos de Vida Saludable')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-start justify-content-center py-5 px-3 bg-light">
    <div class="bg-white p-5 rounded shadow w-100" style="max-width: 1200px; font-size: 1.25rem;">
        <h2 class="text-center mb-4">📝 Test: Estilos de Vida Saludable</h2>
        <p class="text-center text-muted mb-4">Selecciona la respuesta correcta. Verás si acertaste al marcarla. Al final, podrás ver tu puntaje total.</p>

        <form id="formulario-test">
            <ol>
                @php
                    $preguntas = [
                        ['p' => '1', 'texto' => '¿Cuál es la cantidad mínima recomendada de agua al día?', 'opciones' => ['1 litro' => false, '2 litros' => true]],
                        ['p' => '2', 'texto' => '¿Cuánto tiempo de ejercicio semanal se recomienda?', 'opciones' => ['60 minutos' => false, '150 minutos' => true]],
                        ['p' => '3', 'texto' => '¿Qué grupo debe ocupar la mayor parte del plato?', 'opciones' => ['Carnes' => false, 'Verduras y frutas' => true]],
                        ['p' => '4', 'texto' => '¿Qué hábito contribuye más a la obesidad infantil?', 'opciones' => ['Comer frutas' => false, 'Ver televisión por más de 2 horas al día' => true]],
                        ['p' => '5', 'texto' => '¿Qué tipo de grasa es más saludable?', 'opciones' => ['Grasas trans' => false, 'Grasas monoinsaturadas' => true]],
                        ['p' => '6', 'texto' => '¿Qué bebida es la mejor opción para hidratarse diariamente?', 'opciones' => ['Gaseosa' => false, 'Agua' => true]],
                        ['p' => '7', 'texto' => '¿Qué significa tener un estilo de vida saludable?', 'opciones' => ['Comer solo vegetales' => false, 'Mantener hábitos positivos en alimentación, sueño, ejercicio y bienestar emocional' => true]],
                        ['p' => '8', 'texto' => '¿Qué beneficio tiene dormir al menos 7–8 horas por noche?', 'opciones' => ['Aumenta el apetito' => false, 'Mejora la concentración y la salud general' => true]],
                        ['p' => '9', 'texto' => '¿Cuál es el efecto del consumo excesivo de azúcar?', 'opciones' => ['Mejora el rendimiento físico' => false, 'Aumenta el riesgo de diabetes y sobrepeso' => true]],
                        ['p' => '10', 'texto' => '¿Cuál es la mejor forma de evitar el estrés?', 'opciones' => ['Comer compulsivamente' => false, 'Practicar técnicas de relajación y mantener una rutina saludable' => true]],
                        ['p' => '11', 'texto' => '¿Qué tipo de alimentos se deben evitar en exceso?', 'opciones' => ['Legumbres' => false, 'Ultraprocesados' => true]],
                        ['p' => '12', 'texto' => '¿Cuál es un ejemplo de comida saludable?', 'opciones' => ['Pizza de pepperoni' => false, 'Arroz integral con verduras y pescado al horno' => true]],
                        ['p' => '13', 'texto' => '¿Qué es una porción adecuada de fruta?', 'opciones' => ['5 manzanas' => false, 'Una pieza mediana o 1 taza picada' => true]],
                        ['p' => '14', 'texto' => '¿Qué se recomienda para reducir el consumo de sal?', 'opciones' => ['Usar salsa de soya' => false, 'Leer etiquetas y cocinar con especias' => true]],
                        ['p' => '15', 'texto' => '¿Qué hábito favorece un sistema inmunológico fuerte?', 'opciones' => ['Tomar antibióticos' => false, 'Comer balanceado, dormir bien y hacer ejercicio' => true]],
                    ];
                @endphp

                @foreach ($preguntas as $pregunta)
                    <li class="mb-5">
                        <strong>{{ $pregunta['texto'] }}</strong><br>
                        @foreach ($pregunta['opciones'] as $opcion => $esCorrecta)
                            @php $id = 'p' . $pregunta['p'] . md5($opcion); @endphp
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="p{{ $pregunta['p'] }}" value="{{ $esCorrecta ? 'correcta' : 'incorrecta' }}" id="{{ $id }}">
                                <label class="form-check-label" for="{{ $id }}">{{ $opcion }}</label>
                            </div>
                        @endforeach
                        <small class="feedback text-muted"></small>
                    </li>
                @endforeach
            </ol>

            <button type="submit" class="btn btn-success mt-4">Finalizar Test</button>
        </form>

        <div id="resultado-final" class="alert alert-info mt-4 d-none"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', function () {
            const feedback = this.closest('li').querySelector('.feedback');
            const name = this.name;

            document.querySelectorAll(`input[name="${name}"]`).forEach(el => {
                el.closest('li').querySelector('.feedback').textContent = '';
            });

            if (this.value === 'correcta') {
                feedback.textContent = '✅ Correcto';
                feedback.className = 'feedback text-success';
            } else {
                feedback.textContent = '❌ Incorrecto';
                feedback.className = 'feedback text-danger';
            }
        });
    });

    document.getElementById('formulario-test').addEventListener('submit', function (e) {
        e.preventDefault();

        let correctas = 0;
        const total = 15;

        for (let i = 1; i <= total; i++) {
            const seleccion = document.querySelector(`input[name="p${i}"]:checked`);
            if (seleccion && seleccion.value === 'correcta') {
                correctas++;
            }
        }

        const resultado = document.getElementById('resultado-final');
        resultado.textContent = `✅ Has obtenido ${correctas} de ${total} respuestas correctas.`;
        resultado.classList.remove('d-none');
    });
</script>
@endsection
