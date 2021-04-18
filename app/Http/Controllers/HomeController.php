<?php

namespace App\Http\Controllers;

use App\Permiso;
use App\User;
use App\Projecto;
use App\Tarea;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projectos = Projecto::latest()->get();

        
        // $tareas = User::select(['tareas_count' => Tarea::whereRaw('user_id  = users.id')
        //     ->selectRaw('count(*)') ])->get();
        return view('projects.listProjectos', compact('projectos'));
    }

    public function permiso()
    {
        $permisos = Permiso::latest()->get();
        return view('permisos', compact('permisos'));
    }

    public function store(Request $request, Tarea $tarea){
        if ($request->estado == 1) {
            $estado = [
                'estado' => $request->estado
            ];
            $tarea->update($estado);
        }

        return back();
    }

    public function update(Request $request, Projecto $projecto){
        if ($request->estado == 1) {
            $estado = [
                'estado' => $request->estado
            ];
            $projecto->update($estado);

            return back();
        }
    }
}
