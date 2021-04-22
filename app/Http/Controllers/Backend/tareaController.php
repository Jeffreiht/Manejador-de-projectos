<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Tarea;
use App\Projecto;
use App\Http\Requests\tareaRequest;
use Illuminate\Support\Facades\DB;

class tareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Projecto $projecto)
    {
        $tareas = Tarea::latest()->get();
        $tareasP = Tarea::where('projecto_id', $projecto->id)->count();
        $tareasC = Tarea::where('estado', 1)
            ->where('projecto_id', $projecto->id)
            ->count();
        $progreso = ($tareasC*100) / $tareasP;
        return view('tasks.listTareas', compact('projecto', 'tareas', 'progreso'));
    }

    public function create(Projecto $projecto){
        $managers = DB::table('users')
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->where('roles.name', '=', 'Manager')
        ->select('users.id', 'users.name')
        ->get(); 
        $empleados = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', '<>', 'Administrador')
            ->where('roles.name', '<>', 'Manager')
            ->select('users.id', 'users.name')
            ->get(); 
        return view('tasks.createTarea', compact('projecto','managers', 'empleados'));
    }

    public function store(tareaRequest $request, Projecto $projecto)
    {
        $tarea = [
            'user_id' => $request->manager_id,
            'projecto_id' => $projecto->id,
            'title' =>$request->title,
            'description' => $request->description
        ];

        $result = Tarea::create($tarea);

        $result->users()->sync($request->empleado_id);

        return redirect('/')->with('status', 'La tarea se a creado correctamente');
    }

    public function edit(Tarea $tarea)
    {
        $managers = DB::table('users')
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->where('roles.name', '=', 'Manager')
        ->select('users.id', 'users.name')
        ->get(); 
        $empleados = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', '<>', 'Administrador')
            ->where('roles.name', '<>', 'Manager')
            ->select('users.id', 'users.name')
            ->get(); 
        return view('tasks.editTarea', compact('tarea', 'managers', 'empleados'));
    }

    public function update(tareaRequest $request, Tarea $tarea)
    {
        $result = [
            'user_id' => $request->manager_id,
            'projecto_id' => $tarea->projecto_id,
            'title' =>$request->title,
            'description' => $request->description
        ];
        $tarea->update($result);

        $tarea->users()->sync($request->empleado_id);

        return redirect('/tareas/'.$tarea->projecto_id)->with('status', 'La tarea se a aptualizado correctamente');
    }

    
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return back()->with('status', 'La tarea se a eliminado correctamente');
    }
}
