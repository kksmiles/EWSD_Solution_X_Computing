<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorContributionController extends Controller
{
    public function index(){
        $getIssues = \App\MagazineIssue::where('staff_id',\Auth::user()->id)->get();
        if(count($getIssues) > 0){
            return view('contributions.coordinator.index',compact('getIssues'));
        }
        return view('contributions.coordinator.index');
    }

    public function show($id) {
        $getContributions = \App\Contributions::where('issue_id',$id)->get();
        $issue = \App\MagazineIssue::findOrfail($id);
        if(count($getContributions) > 0){
            return view('contributions.coordinator.show',compact('getContributions','issue'));
        }
        return view('contributions.coordinator.show');
    }

    // @ publish contribution
    public function publishContribution($con_id){
        $contribution = \App\Contributions::findOrfail($con_id);
        $contribution->is_published = '1';
        $contribution->save();
        return redirect()->back()->with('success', 'Contribution ('.$contribution->title.') is successfully published now');
    }

    // @ reject contribution
    public function rejectContribution($con_id){
        $contribution = \App\Contributions::findOrfail($con_id);
        $contribution->is_published = '2';
        $contribution->save();
        return redirect()->back()->with('success', 'Contribution ('.$contribution->title.') is successfully rejected now');
    }
}
