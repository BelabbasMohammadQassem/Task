<?php

namespace App\Http\Controllers;
use App\Models\Tasks;
use Illuminate\Http\Request;



class TaskController extends Controller {
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


    // Update
    public function create(Request $request)
    {
        // Je veux valider les données reçues
        try {
            $request->validate([
                // champs title du movie (en bdd)
                'title' => 'required|min:3|max:255'
            ]);
        } catch(\Exception $e) {
            // ce bloc sera executé uniquement si la méthode validate throw une exception
            return response()->json(['message' => 'Invalid data'], 400);
        }

        // Créer un film
        $title = new Tasks();
        $title->title = $request->get('title');
        $title->save();

        // ici je m'attends à récupérer également l'id généré automatiquement par la bdd
        return response()->json($title, 201);
    }

    // mettre à jour

    public function update(Request $request, $id)
    {
        // Rechercher les données d'un film
        // SELECT * FROM movies WHERE id = $id
        try {
            $titles = Tasks::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Tasks not found'], 404);
        }

        // Je veux valider les données reçues
        try {
            $request->validate([
                // champs title du movie (en bdd)
                'title' => 'required|min:3|max:255'
            ]);
        } catch(\Exception $e) {
            // ce bloc sera executé uniquement si la méthode validate throw une exception
            return response()->json(['message' => 'Invalid data'], 400);
        }

        // Mettre à jour un film
        $titles->title = $request->get('title');
        $titles->save();

        return response()->json($titles, 200);
    }

    public function delete($id)
    {
        // Rechercher les données d'un film
        // SELECT * FROM movies WHERE id = $id
        try {
            $taskstitle = Tasks::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Tasks not found'], 404);
        }

        // Supprimer un film
        $taskstitle->delete();

        return response()->json(['message' => 'Tasks deleted'], 200);
    }

}
