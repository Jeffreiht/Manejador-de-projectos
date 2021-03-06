<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relacion de mucho a muchos
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function tareas(){
        return $this->belongsToMany(Tarea::class);
    }

    //Relacion de uno a muchos
    public function projectos(){
        return $this->hasMany(Projecto::class);
    }
    public function tasks(){
        return $this->hasMany(Tarea::class);
    }

    // public function permisos(){
    //     return $this->hasManyThrough(Permiso::class, Role::class);
    // }

    //Scope para los buscadores
    public function scopeUser($query, $user){
        if ($user) {
            $query->where('name', 'LIKE', "%$user%");
        }
    }

    public function scopeRole($query, $role){
        if ($role) {
            $query->whereHas('roles', function ($q) use ($role){
                $q->where('name', 'LIKE', '%'.$role.'%');
            });
        }
    }
}
