<?php

namespace App\Http\Controllers;

use App\MagazineIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MagazineIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magazine_issues = MagazineIssue::all();
        return view('magazine_issue.index', compact('magazine_issues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = \App\User::where('role_id', 3)->get();
        $faculties = \App\Faculty::all();
        $academic_years = \App\AcademicYear::all();
        return view('magazine_issue.create', compact('staffs', 'faculties', 'academic_years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'staff_id' => ['required', 'numeric', 'exists:users,id'],
            'faculty_id' => ['required', 'numeric', 'exists:faculties,id'],
            'academic_year_id' => ['required', 'numeric', 'exists:academic_years,id'],
            'title' => ['required', 'max:255'],
            'description' => ['nullable'],
            'submission_closure_date' => ['required', 'date', 'after:today'],
            'modification_closure_date' => ['required', 'date', 'after:submission_closure_date'],
            'image' => ['nullable', 'image'],
            'file' => ['nullable', 'mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        if($request->hasFile('image'))
        {
            $extension = $request->image->extension();
            $request->image->storeAs('/public/magazine_issues/images/', $attributes['title'].".".$extension);
            $url = Storage::url("magazine_issues/images/".$attributes['title'].".".$extension);
            $attributes['image']=$url;
        }
        if($request->hasFile('file'))
        {
            $extension = $request->file->extension();
            $request->file->storeAs('/public/magazine_issues/file/', $attributes['title'].".".$extension);
            $url = Storage::url("magazine_issues/file/".$attributes['title'].".".$extension);
            $attributes['file']=$url;
        }
        MagazineIssue::create($attributes);
        return redirect()->route('magazine-issues.index')->with('success', 'Magazine created successfully!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MagazineIssue  $magazine_issue
     * @return \Illuminate\Http\Response
     */
    public function show(MagazineIssue $magazine_issue)
    {
        return view('magazine_issue.show', compact('magazine_issue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MagazineIssue  $magazine_issue
     * @return \Illuminate\Http\Response
     */
    public function edit(MagazineIssue $magazine_issue)
    {
        $staffs = \App\User::where('role_id', 3)->get();
        $faculties = \App\Faculty::all();
        $academic_years = \App\AcademicYear::all();
        return view('magazine_issue.edit', compact('magazine_issue','staffs', 'faculties', 'academic_years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MagazineIssue  $magazine_issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MagazineIssue $magazine_issue)
    {
        $attributes = request()->validate([
            'staff_id' => ['required', 'numeric', 'exists:users,id'],
            'faculty_id' => ['required', 'numeric', 'exists:faculties,id'],
            'academic_year_id' => ['required', 'numeric', 'exists:academic_years,id'],
            'title' => ['required', 'max:255'],
            'description' => ['nullable'],
            'submission_closure_date' => ['required', 'date', 'after:today'],
            'modification_closure_date' => ['required', 'date', 'after:submission_closure_date'],
            'image' => ['nullable', 'image'],
            'file' => ['nullable', 'mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        if($request->hasFile('image'))
        {
            $extension = $request->image->extension();
            $request->image->storeAs('/public/magazine_issues/images/', $attributes['title'].".".$extension);
            $url = Storage::url("magazine_issues/images/".$attributes['title'].".".$extension);
            $attributes['image']=$url;
            $magazine_issue->image = $attributes['image'];
        }
        if($request->hasFile('file'))
        {
            $extension = $request->file->extension();
            $request->file->storeAs('/public/magazine_issues/file/', $attributes['title'].".".$extension);
            $url = Storage::url("magazine_issues/file/".$attributes['title'].".".$extension);
            $attributes['file']=$url;
            $magazine_issue->file = $attributes['file'];
        }
        $magazine_issue->staff_id = $attributes['staff_id'];
        $magazine_issue->faculty_id = $attributes['faculty_id'];
        $magazine_issue->academic_year_id = $attributes['academic_year_id'];
        $magazine_issue->title = $attributes['title'];
        $magazine_issue->description = $attributes['description'];
        $magazine_issue->submission_closure_date = $attributes['submission_closure_date'];
        $magazine_issue->modification_closure_date = $attributes['modification_closure_date'];
        $magazine_issue->save();
        
        return redirect()->route('magazine-issues.index')->with('success', 'Magazine updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MagazineIssue  $magazine_issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(MagazineIssue $magazine_issue)
    {
        $magazine_issue->delete();
        return redirect()->route('magazine-issues.index')->with('success', 'Magazine Issue Deleted Successfully');
    }
}
