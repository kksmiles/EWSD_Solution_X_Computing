<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MagazineIssue;
use App\Contributions;
use App\Faculty;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CoordinatorContributionController extends Controller
{
    public function index(){
        $coordinatorContributions = [];
        $contributions = Contributions::all();
        if(Gate::allows('isMarketingManager')){
            $coordinatorContributions = $contributions;
            return view('contributions.coordinator.index',compact('coordinatorContributions'));
        }
        foreach($contributions as $contribution) {
            if($contribution->magazineIssue->faculty->id == Auth::user()->faculties->first()->id)
            $coordinatorContributions[] = $contribution;
        }
        if(isset($coordinatorContributions)) {
            return view('contributions.coordinator.index',compact('coordinatorContributions'));
        }
        return view('contributions.coordinator.index',compact('coordinatorContributions'));
    }
    public function showContributionsInFaculty(Faculty $faculty) {
        
        $coordinatorContributions = $faculty->contributions;
        return view('contributions.coordinator.index',compact('coordinatorContributions'));
    }

    public function show($id) {
        $issues = Auth::user()->magazine_issues;
        $coordinatorContributions =  Contributions::where('issue_id',$id)->get();
        if(count($coordinatorContributions) > 0){
            return view('contributions.coordinator.index',compact('coordinatorContributions','issues','id'));
        }
        return view('contributions.coordinator.index');
    }

    // @ publish contribution
    public function publishContribution($con_id){
        $contribution =  Contributions::findOrfail($con_id);
        $contribution->is_published = '1';
        $contribution->save();
        return redirect()->back()->with('success', 'Contribution ('.$contribution->title.') is successfully published now');
    }

    // @ reject contribution
    public function rejectContribution($con_id){
        $contribution =  Contributions::findOrfail($con_id);
        $contribution->is_published = '2';
        $contribution->save();
        return redirect()->back()->with('success', 'Contribution ('.$contribution->title.') is successfully rejected now');
    }
    public function urlHelper(Request $request){
        return redirect()->route('coordinator.magazine-issues.contributions.show',$request->issue_id);
    }
}
