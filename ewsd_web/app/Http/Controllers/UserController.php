<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\UserFaculty;
use App\UserRoles;
use App\Faculty;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        if(Gate::denies('isAdmin')) {
            return redirect()->route('home')->with('fail','Only Admin can view users');
        }
        
        $user_roles = UserRoles::all();
        $users = User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $current_user_f_id = $user->faculties->pluck('id')->toArray();
        $faculties = Faculty::all();
        $roles = UserRoles::all();
        return view('user.detail',compact('user','faculties','current_user_f_id','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        if(Gate::allows('isAdmin')|| $this->authorize('update', $user)) {
            return view('user.edit',compact('user'));
        } 
        return redirect()->route('home')->with('fail','Only Admin can edit users');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {   
        if(Gate::allows('isAdmin')|| $this->authorize('update', $user)) {
            $validatedData = $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'fullname' => ['required', 'string', 'max:255'],
             ]);
            
             if($request['new_image'] == null)
             {
                $file_path = $request['old_image'];
             }
             else {
                $profile_image = $request['new_image'];
                $upload_path = public_path().'/storage/images/'; 
                $file_name = $profile_image->getClientOriginalName();
                $profile_image->move($upload_path,$file_name);
                $file_path = '/storage/images/'.$file_name;   
             }
            
            $user->username = $request['username'];
            $user->fullname = $request['fullname'];
            $user->image = $file_path;
            $user->save();

            return redirect()->route('users.index');       
        } 
        return redirect()->route('home')->with('fail','Only Admin can edit users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if(Gate::allows('isAdmin')|| $this->authorize('update', $user)) {
            $user = User::find($id);
            $user->faculties()->detach();
            $user->delete();
            return back();
        } 
        return redirect()->route('home')->with('fail','Only Admin can edit users');
    }

    //Assign User From User Detail
    public function assignUserFaculty(Request $request)
    {
         $attributes = request()->validate([
            'faculty_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer']
        ]);
        
        UserFaculty::create($attributes);

        return back()->with('success', 'User Faculty created successfully!');
    }

     //Assign User From User Detail
    public function unassignUserFaculty(Request $request)
    {
        $faculty = UserFaculty::where('user_id',$request->user_id)->where('faculty_id',$request->faculty_id)->delete();
        
        
        return back()->with('success', 'User Faculty deleted successfully!');
    }

     //Assign User Role
    public function assignUserRole(Request $request)
    {
       
        $user = User::find($request->user_id);
        $user->role_id = $request->role_id;
        $user->update();
        return back()->with('success', 'Assigned user role successfully!');
    }


    
}
