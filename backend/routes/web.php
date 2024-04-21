<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/tasks', [TasksController::class, 'index']);

// Détail d'un film
// {id} => paramètre dynamique (qui remplace Altorouter -> [i:id])
// le where me permet de venir spécifier via une regex (une expression régulière) le format de la valeur attendue
Route::get('/tasks/{id}', [TasksController::class, 'show'])->where('id', '[0-9]+');

