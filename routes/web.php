<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//agregado por Josue
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use Illuminate\Support\Carbon;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\IntervencionController;

Route::get('/', function () {
    return view('home');
});


Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// rutas agregadas por Josue

Route::get('/evaluacion', function () {
    return view('evaluacion');
})->middleware(['auth'])->name('evaluacion');



Route::get('/diagnostico', function () {
    $ultima = Evaluation::where('user_id', Auth::id())->latest()->first();
    return view('diagnostico.diagnostico', compact('ultima'));
})->middleware(['auth'])->name('diagnostico');


Route::get('/quiensoy', function () {
    return Auth::user();
});



Route::get('/intervencion', function () {
    return view('intervencion');
})->middleware(['auth'])->name('intervencion');

Route::get('/monitoreo', function () {
    return view('monitoreo');
})->middleware(['auth'])->name('monitoreo');

//agregado por Josue


Route::post('/evaluacion', [EvaluationController::class, 'store'])
    ->middleware(['auth'])
    ->name('evaluacion.store');


//agregado por JMC


//agregadop por jfm

Route::get('/evaluaciones', function () {
    $evaluaciones = Evaluation::where('user_id', Auth::id())->latest()->get();
    return view('evaluaciones.index', compact('evaluaciones'));
})->middleware(['auth'])->name('evaluaciones.index');


//eliminar
Route::get('/debug-evals', function () {
    return Auth::user()->evaluations;
});

//MODULO INTERVENCION


// En web.php
Route::get('/intervencion/modulo/{modulo}', [IntervencionController::class, 'modulo'])
    ->middleware(['auth'])
    ->name('intervencion.modulo');

Route::get('/intervencion', function () {
    return view('intervencion.index');
})->name('intervencion.index');

Route::get('/intervencion/test', function () {
    return view('intervencion.test');
})->name('intervencion.test');

Route::get('/intervencion/entrevista', function () {
    return view('intervencion.entrevista');
})->name('intervencion.entrevista');
