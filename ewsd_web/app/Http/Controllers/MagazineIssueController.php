<?php

namespace App\Http\Controllers;

use App\MagazineIssue;
use App\AcademicYear;
use App\User;
use App\Faculty;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MagazineIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        if(Gate::allows('isMarketingCoordinator')) {

            $magazine_issues = Auth::user()->magazine_issues;
            return view('magazine_issue.index', compact('magazine_issues'));

        } elseif(Gate::allows('isSupervisor')) {

            $faculties = Faculty::all();
            $magazine_issues = MagazineIssue::all();
            return view('magazine_issue.index', compact('magazine_issues','faculties'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $staffs = User::where('role_id', 3)->get();
        $user = Auth::user();
        $faculty = $user->faculties->first();
        $faculties = Faculty::all();
        $staffs = User::all();
        $academic_years = AcademicYear::all();
        return view('magazine_issue.create', compact('user', 'faculty', 'academic_years','faculties','staffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $academic_year_closure_date = AcademicYear::findOrFail(request('academic_year_id'))->closure_date;
        $attributes = request()->validate([
            'staff_id' => ['required', 'numeric', 'exists:users,id'],
            'faculty_id' => ['required', 'numeric', 'exists:faculties,id'],
            'academic_year_id' => ['required', 'numeric', 'exists:academic_years,id'],
            'title' => ['required', 'max:255'],
            'description' => ['nullable'],
            'submission_closure_date' => ['required', 'date', 'after:today', 'before:modification_closure_date'],
            'modification_closure_date' => ['required', 'date', 'before:'. $academic_year_closure_date],
            'image' => ['nullable', 'image'],
            'file' => ['nullable', 'mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image'))
        {
            $image_name = $current_timestamp . "_" . $request->image->getClientOriginalName();
            $extension = $request->image->extension();
            $request->image->storeAs('/public/magazine_issues/images/', $image_name. "." .$extension);
            $image_url = Storage::url("magazine_issues/images/". $image_name. "." .$extension);
            $attributes['image']=$image_url;
        }
        if($request->hasFile('file'))
        {
            $file_name = $current_timestamp . "_" . $request->file->getClientOriginalName();
            $extension = $request->file->extension();
            $request->file->storeAs('/public/magazine_issues/file/', $file_name. "." .$extension);
            $file_url = Storage::url("magazine_issues/file/" .$file_name. "." .$extension);
            $attributes['file']=$file_url;
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
        if(Gate::allows('isMarketingCoordinator') && Gate::authorize('view',$magazine_issue)){
            return view('magazine_issue.show', compact('magazine_issue'));
        } elseif (Gate::allows('isStudent') && Gate::authorize('inStudentFaculty',$magazine_issue)){
            return view('student.magazine-issue.show', compact('magazine_issue'));
        }
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
        $academic_year_closure_date = AcademicYear::findOrFail(request('academic_year_id'))->closure_date;
        $attributes = request()->validate([
            'staff_id' => ['required', 'numeric', 'exists:users,id'],
            'faculty_id' => ['required', 'numeric', 'exists:faculties,id'],
            'academic_year_id' => ['required', 'numeric', 'exists:academic_years,id'],
            'title' => ['required', 'max:255'],
            'description' => ['nullable'],
            'submission_closure_date' => ['required', 'date', 'after:today', 'before:modification_closure_date'],
            'modification_closure_date' => ['required', 'date', 'before:'. $academic_year_closure_date],
            'image' => ['nullable', 'image'],
            'file' => ['nullable', 'mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image'))
        {
            $image_name = $current_timestamp . "_" . $request->image->getClientOriginalName();
            $extension = $request->image->extension();
            $request->image->storeAs('/public/magazine_issues/images/', $image_name. "." .$extension);
            $image_url = Storage::url("magazine_issues/images/". $image_name. "." .$extension);
            $magazine_issue->image = $image_url;
        }
        if($request->hasFile('file'))
        {
            $file_name = $current_timestamp . "_" . $request->file->getClientOriginalName();
            $extension = $request->file->extension();
            $request->file->storeAs('/public/magazine_issues/file/', $file_name. "." .$extension);
            $file_url = Storage::url("magazine_issues/file/" .$file_name. "." .$extension);
            $magazine_issue->file = $file_url;
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

    public function checkStaffIssues($user_id) {
        $magazine_issues = MagazineIssue::where('staff_id',$user_id)->get();
        if(Gate::authorize('view',$magazine_issues[0])){
            return view('magazine_issue.index',compact('magazine_issues'));
        }
        return redirect()->route('home')->with('error','You can only view magazine issues of your faculty.');
    }

    public function getIssuesInFaculty($id) {
       
        if (Gate::allows('isStudent')) {
            $faculty = Faculty::find($id);
            $all_magazine_issues = Faculty::find($id)->magazine_issues;
            //Show only magazine issues from active academic year
            $magazine_issues = new Collection();
            foreach($all_magazine_issues as $magazine_issue)
            {
                if($magazine_issue->academic_year->isCurrentAcademicYear())
                {
                    $magazine_issues->push($magazine_issue);
                }
            }
            if(count($magazine_issues)>0 && Gate::authorize('inStudentFaculty',$magazine_issues[0])) {
                session()->flash('header', "of $faculty->name");
                return view('student.magazine-issue.index', compact('magazine_issues'));
            } else {
                return view('student.magazine-issue.empty');
            }
        } 
        
    }

    public function getStudentIssues() {
        $faculties = Auth::user()->faculties;
        if(count($faculties) > 0){
            foreach($faculties as $faculty) {
                if(count($faculty->magazine_issues) > 0) {
                    foreach($faculty->magazine_issues as $magazine_issue) {
                        $all_magazine_issues [] = $magazine_issue;
                    }
                }
            }
        } else {
            $magazine_issues = [];
            foreach($faculties as $faculty) {
                if(count($faculty->magazine_issues) > 0) {
                    foreach($faculty->magazine_issues as $magazine_issue) {
                        $all_magazine_issues [] = $magazine_issue;
                    }
                }
            }
        }
        //Show only magazine issues from active academic year
        $magazine_issues = new Collection();
        foreach($all_magazine_issues as $magazine_issue)
        {
            if($magazine_issue->academic_year->isCurrentAcademicYear())
            {
                $magazine_issues->push($magazine_issue);
            }
        }
        session()->flush();
        return view('student.magazine-issue.index',compact('magazine_issues'));
    }

    public function getStudentContributionsOfIssue(MagazineIssue $magazine_issue) {
        $contributions = $magazine_issue->contributions->where('student_id',Auth::id());
        foreach($contributions as $contribution) {
            $contribution->magazineIssueTitle = $contribution->magazineIssue->title;
            $contribution->facultyName = $contribution->faculty()->name;
            $contribution->academicYear = $contribution->magazineIssue->academic_year->title;
        }
        session()->flash('header', "of $magazine_issue->title");
        return view('student.contribution.index',compact('contributions'));
    }
}
