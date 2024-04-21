<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Task extends Model{
    public $table = 'tasks';

      // timestamp : false => Laravel ne va pas chercher à gérer les colonnes created_at et updated_at
      public $timestamps = false;
}
