<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       $user = App\User::create([
            'name' => 'Jeffrei Hernandez',
            'email' => 'hjefrei@gmail.com',
            'password' => bcrypt('16052010')
        ]);

        $role = App\Role::create([
            'name'=> 'Administrador',
            'description' => 'Administra toda la pagina'
        ]);

        $user->roles()->sync($role);

        $permiso = App\Permiso::create([
            'name' => 'Acceso Full',
            'description' => 'Puede hacer de todo'
        ]);
        $role->permisos()->sync($permiso);

        App\Permiso::create([
            'name' => 'Crear tarea',
            'description' => 'Puede crear tarea a un projecto y asignar empleados'
        ]);

        App\Permiso::create([
            'name' => 'Acceso Manager',
            'description' => 'Solo puede ver projectos y estar al tanto de sus tareas asignadas'
        ]);

        App\Permiso::create([
            'name' => 'Acceso Empleado',
            'description' => 'Solo puede ver projectos y tareas asignadas'
        ]);
    }
}
