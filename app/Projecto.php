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

    //Scope para los buscadores
    public function scopeAdmin($querty, $user){
        if ($user)
            $querty->whereHas('user', function($q) use ($user){
                $q->where('name', 'LIKE', '%'.$user.'%');
            });
    }

    public function scopeProjecto($querty, $projecto){
        if($projecto)
            $querty->where('name', 'LIKE', "%$projecto%");
    }

    public function scopeFecha($querty, $fecha){
        if($fecha)
            $querty->where('created_at', 'LIKE', "%$fecha%");
    }

    public function scopeEstado($query, $estado){
        $query->where('estado', 'LIKE', "%$estado%");
    }
}
