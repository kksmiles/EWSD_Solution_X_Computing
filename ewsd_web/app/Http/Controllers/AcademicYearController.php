<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcademicYear;
use Illuminate\Validation\Rule;

class AcademicYearController extends Controller
{
    public function index() 
    {
        $academic_years = AcademicYear::all();
        return view('academicyear.index', compact('academic_years'));
    }

    public function create() 
    {
        return view('academicyear.create');
    }

    public function store() 
    {
        $attributes = request()->validate([
            'title' => ['required', 'unique:academic_years','max:255'],
            'description' => ['nullable'],
            'closure_date' => ['date', 'required'],
        ]);
        AcademicYear::create($attributes);
        return redirect()->route('academicyears.index')->with('success', 'Academic Year created successfully!');
    }

    public function show($id) 
    {
        $academic_year = AcademicYear::findOrfail($id);
        return view('academicyear.show', compact('academic_year'));
    }

    public function edit($id) 
    {
        $academic_year = AcademicYear::findOrfail($id);
        return view('academicyear.edit', compact('academic_year'));
    }

    public function update($id)
    {
        $academic_year = AcademicYear::findOrFail($id);
        $attributes = request()->validate([
            'title' => ['required', Rule::unique('academic_years')->ignore($academic_year->id),'max:255'],
            'description' => ['nullable'],
            'closure_date' => ['date', 'required'],
        ]);

        $academic_year->title = $attributes['title'];
        $academic_year->description = $attributes['description'];
        $academic_year->closure_date = $attributes['closure_date'];
        $academic_year->save();

        return redirect()->route('academicyears.index')->with('success', 'Academic Year updated successfully!');
    }
    
    public function destroy($id)
    {
        $academic_year = AcademicYear::findOrfail($id);
        $academic_year->delete();
        return redirect()->route('academicyears.index')->with('success', 'Academic Year deleted successfully!');
    }
}
