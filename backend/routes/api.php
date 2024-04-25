<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

/* Il faut passer systématiquement par la commande
php artisan install:api (vérifier que la ligne api est bien présente dans le fichier bootstrap/app.php) */

// On est déjà dans le fichier api donc on peut enlever le /api

Route::get('/tasks', [TaskController::class, 'list']);
Route::get('/tasks/{id}', [TaskController::class, 'show'])->where('id', '[0-9]+');
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/tasks/{id}', [TaskController::class, 'delete'])->where('id', '[0-9]+');
