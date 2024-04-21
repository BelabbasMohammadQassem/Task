<?php

namespace App\Http\Controllers;
use App\Models\Tasks;


class TasksController extends Controller {
    public function index(){
        $tasks = Tasks::all();

        return response()->json($tasks, 200);
    }

    public function show($id)
    {
        // Rechercher les données d'un film
        // SELECT * FROM movies WHERE id = $id
        try {
            $task = Tasks::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Tasks not found'], 404);
        }

        return response()->json($task, 200);
    }
}
