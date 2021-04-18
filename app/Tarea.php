<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $guarded = [];

    protected $casts = [
        'estado' => 'boolean'
    ];

    //Relacion de muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class);
    }

    //Relacion de uno a muchos
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function projecto(){
        return $this->belongsTo(Projecto::class);
    }
}
