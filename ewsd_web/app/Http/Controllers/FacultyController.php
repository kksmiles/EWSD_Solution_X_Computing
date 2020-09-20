<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;

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

        return redirect()->route('faculty');
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
        return redirect()->route('faculty');
    }

    // Delete Form
    public function delete($id){
        $faculty = Faculty::findOrfail($id);
        $faculty->delete();
        return redirect()->route('faculty');
    }
}
