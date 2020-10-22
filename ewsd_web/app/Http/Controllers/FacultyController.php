<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\UserFaculty;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::all();
        if(Gate::allows('isStudent')){
            $faculties = Auth::user()->faculties;
            return view('student.faculty.index',compact('faculties'));
        } else if (Gate::allows('isMarketingCoordinator')) {
            $faculty = Auth::user()->faculties->first();
            return redirect()->route('coordinator.faculty.show',($faculty->id));
        }
        return view('faculty.index',compact('faculties'));
    }

    // Add Form
    public function addView(){
        return view('faculty.add');
    }
    public function show(Faculty $faculty){
        return view('faculty.show',compact('faculty'));
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
