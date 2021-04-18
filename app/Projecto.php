<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projecto extends Model
{
    protected $guarded =[];

    protected $casts = [
        'estado' => 'boolean'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tareas(){
        return $this->hasMany(Tarea::class);
    }
}
