@extends('layouts.app')

@section('content')
<header class="bg-green-600 text-black p-6 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        {{-- Logo a la izquierda --}}
        <div>
            <h1 class="text-2xl font-bold">NutriHealth</h1>
        </div>

                {{-- Carrito a la derecha --}}
        <div class="flex items-center space-x-4">
            <a href="/comprar" title="Carrito de compra">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 5.1a1 1 0 001 1.3h11a1 1 0 001-1.3L17 13M9 21h.01M15 21h.01" />
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



<main class="max-w-7xl mx-auto px-4 py-10 space-y-12">
    <div class="text-center">
        <img src="/images/nutricion.jpg" alt="Imagen principal" class="w-full rounded-lg shadow mb-6">
        <h2 class="text-4xl font-bold text-green-700">Bienvenid@s a NutriHealth</h2>
        <p class="text-2xl text-gray-700 mt-4 italic">"El cambio de hábitos alimentarios es el primer paso hacia una vida saludable y sostenible."</p>
    </div>

    <div class="flex flex-wrap justify-between gap-4">
    <a href="/evaluacion" class="flex-1 min-w-[200px] max-w-[23%] bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">

            <img src="/images/evaluacion.jpg" alt="Evaluación" class="w-full h-40 object-cover">
            <div class="p-4 text-center">
                <h3 class="font-bold text-xl mb-2 text-green-700">Evaluación</h3>
                <p class="text-gray-600">Registra tus datos corporales y conocimientos.</p>
            </div>
        </a>
        <a href="/diagnostico" class="flex-1 min-w-[200px] max-w-[23%] bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">

            <img src="/images/diagnostico.jpg" alt="Diagnóstico" class="w-full h-40 object-cover">
            <div class="p-4 text-center">
                <h3 class="font-bold text-xl mb-2 text-yellow-700">Diagnóstico</h3>
                <p class="text-gray-600">Conoce tu situación nutricional.</p>
            </div>
        </a>
        <a href="/intervencion" class="flex-1 min-w-[200px] max-w-[23%] bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">

            <img src="/images/intervencion.jpg" alt="Intervención" class="w-full h-40 object-cover">
            <div class="p-4 text-center">
                <h3 class="font-bold text-xl mb-2 text-blue-700">Intervención</h3>
                <p class="text-gray-600">Plan de educación alimentaria personalizado.</p>
            </div>
        </a>
        <a href="/monitoreo" class="flex-1 min-w-[200px] max-w-[23%] bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">

            <img src="/images/monitoreo.jpg" alt="Monitoreo" class="w-full h-40 object-cover">
            <div class="p-4 text-center">
                <h3 class="font-bold text-xl mb-2 text-purple-700">Monitoreo</h3>
                <p class="text-gray-600">Haz seguimiento de tu progreso.</p>
            </div>
        </a>
    </div>

    <div class="text-center">
        <h3 class="text-3xl font-bold mb-4">¡Empieza hoy!</h3>
        <p class="text-xl text-gray-700 mb-4">Accede a todo el contenido, sesiones y seguimiento.</p>
        <a href="/comprar" class="inline-block bg-green-600 text-black px-8 py-4 rounded text-lg hover:bg-green-700 transition">Comprar Servicio</a>
    </div>

    <div class="flex gap-6 mt-16">
    <div class="flex-1 basis-1/3 bg-white shadow rounded-lg p-6 text-center">
        <img src="/images/testimonio1.jpg"
        alt="Testimonio 1"
        class="w-28 h-28 mx-auto rounded-full object-cover border-4 border-green-200 shadow-lg" />

        <h4 class="font-bold text-xl text-gray-800">Ana Martínez</h4>
        <p class="text-gray-600 mt-2">"NutriHealth me ayudó a entender mi alimentación y transformar mi estilo de vida."</p>
    </div>
    <div class="flex-1 basis-1/3 bg-white shadow rounded-lg p-6 text-center">
        <img src="/images/testimonio2.jpg"
        alt="Testimonio 1"
        class="w-28 h-28 mx-auto rounded-full object-cover border-4 border-green-200 shadow-lg" />

        <h4 class="font-bold text-xl text-gray-800">Carlos Gómez</h4>
        <p class="text-gray-600 mt-2">"Gracias a su plan de intervención, aprendí a organizar mis comidas con conciencia."</p>
    </div>
    <div class="flex-1 basis-1/3 bg-white shadow rounded-lg p-6 text-center">
        <img src="/images/testimonio3.jpg"
        alt="Testimonio 1"
        class="w-28 h-28 mx-auto rounded-full object-cover border-4 border-green-200 shadow-lg" />

        <h4 class="font-bold text-xl text-gray-800">Laura Ruiz</h4>
        <p class="text-gray-600 mt-2">"Monitorear mi evolución con esta app ha sido clave para mantenerme enfocada."</p>
    </div>
</div>


    <div class="mt-16 max-w-xl mx-auto bg-gray-100 p-6 rounded-lg shadow">
        <h3 class="text-2xl font-bold text-center mb-4">Contáctanos</h3>
        <form action="/contacto" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="nombre" placeholder="Tu nombre" class="w-full p-2 border rounded">
            <input type="email" name="email" placeholder="Tu email" class="w-full p-2 border rounded">
            <textarea name="mensaje" rows="4" placeholder="Tu mensaje" class="w-full p-2 border rounded"></textarea>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Enviar mensaje</button>
        </form>
    </div>
</main>

<footer class="bg-gray-800 text-white p-6 mt-16">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-center space-y-4 md:space-y-0">
        <p>&copy; 2025 NutriHealth. Todos los derechos reservados.</p>
        <div class="space-x-6">
            <a href="/politica-privacidad" class="hover:underline">Política de privacidad</a>
            <a href="/politica-cookies" class="hover:underline">Política de cookies</a>
        </div>
    </div>
</footer>
@endsection








