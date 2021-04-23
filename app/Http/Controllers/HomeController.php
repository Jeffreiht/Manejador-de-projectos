<?php

namespace App\Http\Controllers;

use App\Permiso;
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
    public function index(Request $request)
    {
        $user = $request->user;
        $projecto = $request->projecto;
        $fecha = $request->get('fecha-creacion');
        $estado = $request->estado;
        $projectos = Projecto::latest()
            ->admin($user)
            ->projecto($projecto)
            ->fecha($fecha)
            ->estado($estado)
            ->paginate();
        return view('projects.listProjectos', compact('projectos'));
    }

    public function permiso(Request $request)
    {
        $name = $request->name;
        $permisos = Permiso::latest()
            ->name($name)
            ->paginate(3);
        return view('permisos', compact('permisos'));
    }

    public function store(Request $request, Tarea $tarea)
    {
        if ($request->estado == 1) {
            $estado = [
                'estado' => $request->estado
            ];
            $tarea->update($estado);
        }

        return back();
    }

    public function update(Request $request, Projecto $projecto)
    {
        if ($request->estado == 1) {
            $estado = [
                'estado' => $request->estado
            ];
            $projecto->update($estado);

            return back();
        }
    }
}
