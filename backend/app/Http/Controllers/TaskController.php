<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class TaskController extends Controller {
    public function list(): JsonResponse {
        // on cherche la liste des tasks
        $tasks = Task::all();

        // on retourne la liste des tasks (on est pas obligé de mettre response)
        // par défaut, Laravel retourne les données en JSON
        return response()->json($tasks, 200);
    }

    public function show(int $id): JsonResponse {
        // on cherche la task qui a l'id $id
        $task = Task::find($id);

        // si la task n'existe pas (on peut aussi utiliser directement la méthode findOrFail)
        if ($task === null) {
            // on retourne une erreur 404
            return response()->json(['error' => 'Task not found'], 404);
        }

        // on retourne la task
        return response()->json($task, 200);
    }

    // l'objet Request va être injecté automatiquement par Laravel dans le paramètre (injection de dépendances)
    // request contiendra automatiquement toutes les valeurs de $_POST, $_GET, et $_REQUEST
    public function store(Request $request): JsonResponse {
        // Valider les données
        try {
            $request->validate([
                'title' => 'required|min:10|max:255',
            ]);
        } catch(Exception $e) {
            return response()->json(['error' => 'Validation error'], 404);
        }

        // Récupérer les données (ici du body de la request)
        $title = $request->get('title');

        // On va créer la donnée en base
        $task = new Task();

        // On lui passe les data
        $task->title = $title;

        // On sauvegarde
        // Oups : j'avais mis create à la place de save :)
        $task->save();

        // Récupérer les informations de la requête
        // Statut 201 : tâche a bien été créée
        return response()->json($task, 201);
    }

    /**
     * Met à jour une tâche
     *
     * @param integer $id L'identifiant de la tâche
     * @param Request $request Les données de la requête
     * @return JsonResponse La tâche mise à jour
     */
    public function update(int $id, Request $request): JsonResponse {
        // on cherche la task qui a l'id $id
        try {
            $task = Task::findOrFail($id);
        } catch(Exception $e) {
            return response()->json(['error' => 'Task not found'], SymfonyResponse::HTTP_NOT_FOUND);
        }

        // Valider les données
        try {
            $request->validate([
                'title' => 'required|min:10|max:255',
            ]);
        } catch(Exception $e) {
            return response()->json(['error' => 'Validation error'], SymfonyResponse::HTTP_BAD_REQUEST);
        }

        // Récupérer les données (ici du body de la request)
        $title = $request->get('title');

        // On lui passe les data
        $task->title = $title;

        // On sauvegarde
        $task->save();

        // Récupérer les informations de la requête
        // Statut 200 : tâche a bien été modifiée
        /*
            SymfonyResponse::HTTP_OK peut remplacer le status code 200
        */
        return response()->json($task, SymfonyResponse::HTTP_OK);
    }

    public function delete(int $id): JsonResponse {
        // on cherche la task qui a l'id $id
        try {
            $task = Task::findOrFail($id);
        } catch(Exception $e) {
            return response()->json(['error' => 'Task not found'], SymfonyResponse::HTTP_NOT_FOUND);
        }

        // On supprime la task
        $task->delete();

        // Récupérer les informations de la requête
        // Statut 204 : tâche a bien été supprimée (ou 200 acceptée)
        return response()->json(null, SymfonyResponse::HTTP_NO_CONTENT);
    }
}
