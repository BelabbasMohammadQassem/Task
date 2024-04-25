<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    public $table = 'tasks';        // si le nom de ma table s'apelle 'posts' => la convention de Laravel est de mettre le nom de la table au pluriel (donc 'posts') pour un modèle qui s'apelle 'Post'
    // fichier : Category.php => table : categories (pour respecter la convention de Laravel)

    public $fillable = ['title'];   // les champs que l'on peut remplir

    // timestamps ?
    public $timestamps = true;  // par défaut, timestamps = true
}
