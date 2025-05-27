<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntervencionController extends Controller
{
    //
    // app/Http/Controllers/IntervencionController.php

public function modulo($modulo)
{
    // Puedes usar un array para cargar contenido desde archivos o base de datos
    $modulos = [
        'grupos-alimentos' => [
            'titulo' => 'Grupos de Alimentos',
            'video' => 'https://www.youtube.com/embed/xxxxxxx',
            'pdf' => '/docs/grupos-alimentos.pdf',
            'descripcion' => 'Aprende a identificar los grupos alimenticios...'
        ],
        'planificacion-comidas' => [
            'titulo' => 'Planificación de Comidas',
            'video' => 'https://www.youtube.com/embed/yyyyyyy',
            'pdf' => '/docs/planificacion-comidas.pdf',
            'descripcion' => 'Organiza tus comidas con equilibrio nutricional.'
        ],
        // Agrega más módulos aquí
    ];

    if (!array_key_exists($modulo, $modulos)) {
        abort(404);
    }

    return view('intervencion.modulo', ['contenido' => $modulos[$modulo]]);
}

}
