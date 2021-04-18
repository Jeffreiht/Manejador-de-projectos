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
}
