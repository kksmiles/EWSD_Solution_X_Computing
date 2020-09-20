<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcademicYear;

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
            'title' => 'required',
            'description' => 'required',
            'closure_date' => 'required',
        ]);
        AcademicYear::create($attributes);
        return redirect('/academicyears');
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
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'closure_date' => 'required',
        ]);

        $academic_year = AcademicYear::findOrFail($id);
        $academic_year->title = $attributes['title'];
        $academic_year->description = $attributes['description'];
        $academic_year->closure_date = $attributes['closure_date'];
        $academic_year->save();

        return redirect('/academicyears');
    }
    
    public function destroy($id)
    {
        $academic_year = AcademicYear::findOrfail($id);
        $academic_year->delete();
        return redirect('/academicyears');
    }
}
