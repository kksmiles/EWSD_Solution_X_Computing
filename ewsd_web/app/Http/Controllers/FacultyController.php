<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\UserFaculty;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::all();
        return view('faculty.index',compact('faculties'));
    }

    // Add Form
    public function addView(){
        return view('faculty.add');
    }
    public function show($f_id = 1){
        return redirect()->route('faculty.users.show',$f_id);
    }
    // Save
    public function save(Request $request){
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
        ]);
        $faculty = new Faculty;
        $faculty->name = $request->name;
        $faculty->description = $request->desc;
        $faculty->save();
        return redirect()->route('faculty')->with('success','Faculty created successfully!');
    }

    // Edit Form
    public function edit($id){
        $faculty = Faculty::findOrfail($id);
        return view('faculty.edit', compact('faculty'));
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
        ]);
        $faculty = Faculty::findOrfail($request->id);
        $faculty->name = $request->name;
        $faculty->description = $request->desc;
        $faculty->save();
        return redirect()->route('faculty')->with('success','Faculty updated successfully!');
    }

    // Delete Form
    public function delete($id){
        $faculty = Faculty::findOrfail($id);
        $faculty->delete();
        return redirect()->route('faculty')->with('success','Faculty deleted successfully!');
    }
}
