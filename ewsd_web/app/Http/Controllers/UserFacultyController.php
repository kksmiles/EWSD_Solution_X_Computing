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
        //
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
        return redirect()->route('user_faculty.show',$request->faculty_id)->with('success', 'User Faculty created successfully!');
    }

    public function show($f_id)
    {   
        $user_faculties = UserFaculty::all();
        $faculties = Faculty::all();
        $users_in_faculty = UserFaculty::where('faculty_id',$f_id)->get();

        return view('user_faculty.show', compact('users_in_faculty','faculties','f_id'));
    }

    public function edit(UserFaculty $user_faculty)
    {   
        $user = User::all();
        $faculty = Faculty::all();
        return view('user_faculty.edit', compact('user_faculty', 'user', 'faculty'));
    }

    public function update(Request $request, UserFaculty $user_faculty)
    {
        // 
    }

    public function destroy(UserFaculty $user_faculty)
    {   
        $user_faculty->delete();
        return redirect()->route('user_faculty.index')->with('success', 'User Faculty deleted successfully!'); 
    }

    public function showFaculty(Request $request) 
    {   
        $faculty_id = $request->faculty_id;
        if($request->faculty_id == null) {$faculty_id = 1;} 
        return redirect()->route('user_faculty.show',$faculty_id);
    }
    
    public function addUsersToFaculty($f_id) {
        $users = User::all();
        $users_in_faculty = UserFaculty::where('faculty_id',$f_id)->get();
        foreach($users_in_faculty as $user_in_faculty){
            $users_in[] = $user_in_faculty->user->id;
        }
        return view('user_faculty.create',compact('users','users_in','f_id'));
    }
}
