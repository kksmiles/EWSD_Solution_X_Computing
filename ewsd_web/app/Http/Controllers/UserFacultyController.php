<?php

namespace App\Http\Controllers;

use App\UserFaculty;
use App\User;
use App\Faculty;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class UserFacultyController extends Controller
{

    public function index()
    {
        return redirect()->route('faculty.users.show',1);
    }

    public function create()
    {
        $user = User::all();
        $faculty = Faculty::all();
        return view('user-faculty.create',compact('user','faculty'));
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'faculty_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer']
        ]);
        UserFaculty::create($attributes);
        return redirect()->route('faculty.users.show',$request->faculty_id)->with('success', 'User Faculty created successfully!');
    }

    public function show($id)
    {   
        $user_in_faculty = UserFaculty::where('id',$id)->get()->first();
        if(!$user_in_faculty) {
            return abort(404);
        } 
        return redirect()->route('faculty.users.show',$user_in_faculty->faculty_id);
    }

    public function edit(UserFaculty $user_faculty)
    {   
        $user = User::all();
        $faculty = Faculty::all();
        return view('user-faculty.edit', compact('user_faculty', 'user', 'faculty'));
    }

    public function update(Request $request, UserFaculty $user_faculty)
    {
        // 
    }

    public function destroy(UserFaculty $user_faculty)
    {   
        $f_id = $user_faculty->faculty_id;
        $user_faculty->delete();
        return redirect()->route('faculty.users.show',$f_id); 
    }

    public function showFacultyUsers($f_id = 1) 
    {       
        if (Gate::allows('isMarketingCoordinator')) {
            $facultyCheck = \Auth::user()->faculties->first();
            if($f_id != $facultyCheck->id ){
                return redirect()->route('coordinator.dashboard');
            }
        }
        $user_faculties = UserFaculty::all();
        $faculties = Faculty::all();
        $users_in_faculty = UserFaculty::where('faculty_id',$f_id)->get();

        return view('faculty.show-users', compact('users_in_faculty','faculties','f_id'));
    }
    
    public function addUsersToFaculty($f_id) {
        $users = User::all();
        
        $faculty = Faculty::find($f_id);
        
        $users_in_faculty = UserFaculty::where('faculty_id',$f_id)->get();
        $users_in = [];
        
        foreach($users_in_faculty as $user_in_faculty)
        {
            $users_in[] = $user_in_faculty->user->id;
        }
        
        return view('faculty.add-user',compact('users','users_in','f_id','faculty'));
    }
    public function userFaucltyRouteHelper(Request $request) {
        $f_id = $request->faculty_id;
        if(!$f_id) {
            $f_id = 1;
        }
        if(Gate::allows('isMarketingManager')) {
            return redirect()->route('manager.faculty.users.show',$f_id);
        }
        return redirect()->route('faculty.users.show',$f_id);
    }
}
