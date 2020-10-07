<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contributions;

class ContributionController extends Controller
{
    public function index(){
        return view('contributions.index');
    }

    // ! Student  Contribution
    // show all contributions of auth student
    public function studentAllContribution(){
        $cModel = new Contributions;
        $getOnlyAuthContributions = $cModel->getOnlyAuthContributions();
        if(!count($getOnlyAuthContributions) > 0)
        return redirect()->route('contribution.upload')->with('success', 'Your Contributions does not exist. Please upload now'); 
        $datas = [];
        foreach($getOnlyAuthContributions as $contribution){
            $datas[] = [
                'id' => $contribution->id,
                'issue_name' => $contribution->magazineIssue()->first()->title,
                'faculty_name' => $contribution->magazineIssue()->first()->faculty()->first()->name,
                'acedemic_year' => $contribution->magazineIssue()->first()->academic_year()->first()->title,
                'is_published' => $contribution->is_published,
                'uploaded_at' => $contribution->created_at
            ];
        }
        return view('contributions.student.index',compact('datas'));
    }

    public function upload(){
        $authUser = \Auth::user();
        $ufModel = new \App\UserFaculty;
        $getAuthUserFaculties = $ufModel->getAuthUserFaculties($authUser->id);
        $getIssuesFaculites = \App\MagazineIssue::all();
        $availableMagazineIssuesWithFaculty = [];
        if(count($getAuthUserFaculties) > 0){
            // @ get magazine issues with same faculty (Auth User's faculty is included in Magazine Issue Faculty)
            foreach($getIssuesFaculites as $issue_faculty){
                foreach($getAuthUserFaculties as $au_faculty){
                    if($issue_faculty->faculty_id === $au_faculty->faculty_id){
                        $availableMagazineIssuesWithFaculty[] = $issue_faculty;
                    }
                }
            }
        }
        return view('contributions.student.upload',compact('availableMagazineIssuesWithFaculty'));
    }

    // store
    public function store(Request $request){
        $request->validate([
            'issueId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file' => ['required', 'mimes:jpeg,png,gif,pdf,doc,ppt,zip'],
        ]);
        if($request->hasFile('file')){
            $file = $request['file'];
            $fileName =$file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $file->storeAs('public/contributions/',$fileName);
        }
        $newContribution = new Contributions;
        $newContribution->student_id = \Auth::user()->id;
        $newContribution->issue_id = $request['issueId'];
        $newContribution->title = $request['title'];
        $newContribution->description = $request['description'];
        $newContribution->is_published = '0';
        $newContribution->file = $fileName;
        $newContribution->save();
        return redirect()->route('contribution.upload')->with('success', 'Student Contribution uploaded successfully!');
    }

}
