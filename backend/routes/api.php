<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/api/tasks', [TasksController::class, 'index']);

// Détail d'un film
// {id} => paramètre dynamique (qui remplace Altorouter -> [i:id])
// le where me permet de venir spécifier via une regex (une expression régulière) le format de la valeur attendue
Route::get('/tasks/{id}', [TasksController::class, 'show'])->where('id', '[0-9]+');


// Créer un task (/api/movies dans les faits puisqu'il est dans api.php)
Route::post('/tasks', [TasksController::class, 'create']);

// Mettre à jour un film
Route::put('/tasks/{id}', [TasksController::class, 'update'])->where('id', '[0-9]+');

// Supprimer un task
Route::delete('/tasks/{id}', [TasksController::class, 'delete'])->where('id', '[0-9]+');
