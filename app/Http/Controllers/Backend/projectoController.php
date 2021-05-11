<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Projecto;
use App\Http\Requests\projectoRequest;

class projectoController extends Controller
{
    
    public function __construct()
    {                  
        $this->middleware('auth');
        $this->middleware('permiso');
    }

    
    public function create()
    {
        return view('projects.createProjecto');
    }

   
    public function store(projectoRequest $request)
    {
        $projecto = [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description
        ];

        $result = Projecto::create($projecto);

        return redirect('/')->with('status', 'Projecto creado correctamente');
    }

  
    public function edit(Projecto $projecto)
    {
        return view('projects.editProjecto', compact('projecto'));
    }

  
    public function update(projectoRequest $request, Projecto $projecto)
    {
        
        $projecto->update($request->all());
        return redirect('/')->with('status', 'Projecto aptucalizado correctamente ');

    }

   
    public function destroy(Projecto $projecto)
    {
        $projecto->delete();

        return back()->with('status', 'Projecto eliminado correctamente');
    }
}
