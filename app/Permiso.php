<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $guarded = [];

    //Relacion de mucho a muchos
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    //Scope para los buscadores
    public function scopeName($query, $name){
        $query->where('name', 'LIKE', "%$name%");
    }
}
