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

    //Scope para los buscadores
    public function scopeRole($query, $role){
        if ($role) {
            $query->where('name', 'LIKE', "%$role%");
        }
    }

    public function scopePermiso($query, $permiso){
        if($permiso)
            $query->whereHas('permisos', function($q) use ($permiso){
                $q->where('name', 'LIKE', '%'.$permiso.'%');
            });
    }
}
