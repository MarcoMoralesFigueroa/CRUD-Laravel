<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

Route::get('/', function () {
    return view('home');
});

Route::resource('/alumnos', AlumnoController::class);
Route::get('/eliminados', AlumnoController::class)->name('alumnos.deleted');
Route::patch('/alumnos/{id}/restore', [AlumnoController::class, 'restore'])->name('alumnos.restore');

Route::fallback(function () {
    return view('404');
});