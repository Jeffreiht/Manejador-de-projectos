<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Http\Requests\userRequest;
use App\Http\Requests\editUserRequest;
use Illuminate\Http\Request;

class userController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user;
        $role = $request->role;
        $users = User::latest()
            ->user($user)
            ->role($role)
            ->paginate(2);
        $roles = Role::latest()->get();
        return view('users.user', compact('users', 'roles'));
    }

    public function store(userRequest $request)
    {
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        $result = User::create($user);

        $result->roles()->sync($request->role_id);

        return back()->with('status', 'Se creo el usuario correctamente');
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('users.editUser', compact('user', 'roles'));
    }

    public function update(editUserRequest $request, User $user)
    {
        if ($request->password) {
            $result = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ];

            $user->update($result);
            
            $user->roles()->sync($request->role_id);
        }else{
            $result = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            $user->update($result);
            
            $user->roles()->sync($request->role_id);
            
        }

        return redirect('/usuario')->with('status', 'El usuario se edito correctamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('status', 'El usuario se elimino correctamente');
    }
}
