<?php

namespace App\Http\Controllers;

use App\UserFaculty;
use App\User;
use App\Faculty;

use Illuminate\Http\Request;

class UserFacultyController extends Controller
{

    public function index()
    {
        $user_faculty = UserFaculty::all();
        return view('user_faculty.index', compact('user_faculty'));
    }

    public function create()
    {
        $user = User::all();
        $faculty = Faculty::all();
        return view('user_faculty.create',compact('user','faculty'));
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'faculty_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer']
        ]);
        UserFaculty::create($attributes);
        return redirect()->route('user_faculty.index')->with('success', 'User Faculty created successfully!');
    }

    public function show(UserFaculty $user_faculty)
    {
        return view('user_faculty.show', compact('user_faculty'));
    }

    public function edit(UserFaculty $user_faculty)
    {   
        $user = User::all();
        $faculty = Faculty::all();
        return view('user_faculty.edit', compact('user_faculty', 'user', 'faculty'));
    }

    public function update(Request $request, UserFaculty $user_faculty)
    {
        $validatedData = request()->validate([
            'faculty_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer']
        ]);

        $user_faculty->faculty_id = $validatedData['faculty_id'];
        $user_faculty->user_id = $validatedData['user_id'];
        $user_faculty->save();

        return redirect()->route('user_faculty.index');
    }

    public function destroy(UserFaculty $user_faculty)
    {
        $user_faculty->delete();
        return redirect()->route('user_faculty.index')->with('success', 'User Faculty deleted successfully!'); 
    }
}
