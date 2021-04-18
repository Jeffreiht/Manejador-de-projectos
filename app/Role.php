<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    //Relacion de mucho a muchos
    public function users(){
        return $this->belongsTomany(User::class);
    }
    public function permisos(){
        return $this->belongsToMany(Permiso::class);
    }
}
