<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Role;
use App\Permiso;
use App\Http\Requests\roleRequest;
use Illuminate\Http\Request;

class roleController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $role = $request->role;
        $permiso = $request->permiso;

        $roles = Role::latest()
            ->role($role)
            ->permiso($permiso)
            ->paginate(2);
        $permisos = Permiso::latest()->get();

        return view('roles.roles', compact('roles','permisos'));
    }

    public function store(roleRequest $request)
    {
        $role = [
            'name' => $request->name,
            'description' => $request->description
        ];

        $result = Role::create($role);

        $result->permisos()->sync($request->permiso_id);

        return back()->with('status', 'El role se a creado correctamente');
    }

    public function edit(Role $role)
    {
        $permisos = Permiso::latest()->get();
        return view('roles.editRoles', compact('role', 'permisos'));
    }

    public function update(roleRequest $request, Role $role)
    {
        $result = [
            'name' => $request->name,
            'description' => $request->description
        ];
        $role->update($result);

        $role->permisos()->sync($request->permiso_id);
        return redirect('/role')->with('status', 'El role se a aptualizado correctamente');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('status','El role se a eliminado correctamente');
    }
}
