<?php

namespace App\Http\Controllers;

use App\UserRoles;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{

    public function index()
    {
        $user_roles = UserRoles::all();
        return view('user_roles.index', compact('user_roles'));
    }

    public function create()
    {
        return view('user_roles.create');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'roles' => ['required', 'max:255']
        ]);
        UserRoles::create($attributes);
        return redirect()->route('user_roles.index')->with('success', 'User Role created successfully!');

    }

    public function show(UserRoles $user_role)
    {
        return view('user_roles.show', compact('user_role'));
    }

    public function edit(UserRoles $user_role)
    {
        return view('user_roles.edit', compact('user_role'));
    }

   
    public function update(Request $request, UserRoles $user_role)
    {
        $validatedData = $request->validate([
            'roles' => ['required', 'max:255']
         ]);
        
        $user_role->roles = $validatedData['roles'];
        $user_role->save();

        return redirect()->route('user_roles.index');
    }

    public function destroy(UserRoles $user_role)
    {   
        $user_role->delete();
        return redirect()->route('user_roles.index')->with('success', 'User Role deleted successfully!');        
    }
}
