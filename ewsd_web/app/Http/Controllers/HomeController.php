<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Gate::allows('isMarketingCoordinator')) {
        $magazineIssueCount = \App\MagazineIssue::where('staff_id',\Auth::user()->id)
                                ->count();
        $facultyId      =   \App\UserFaculty::where('user_id',\Auth::user()->id)->select('faculty_id')->first();
        $studentCount   =   \DB::table('faculties as f')
                            ->join('user_faculty','user_faculty.faculty_id','=','f.id')
                            ->join('users','users.id','=','user_faculty.user_id')
                            ->where('users.role_id','4')
                            ->where('f.id', $facultyId->faculty_id )
                            ->count();
        $contributionsPublishedCount =  DB::table('contributions')
                                    ->join('magazine_issues', 'magazine_issues.id', '=', 'contributions.issue_id')
                                    ->join('faculties', 'faculties.id', '=', 'magazine_issues.faculty_id')
                                    ->where('contributions.is_published','1')
                                    ->where('faculties.id',$facultyId->faculty_id )
                                    ->count();
        $contributionsPendingReject =  DB::table('contributions')
                                    ->join('magazine_issues', 'magazine_issues.id', '=', 'contributions.issue_id')
                                    ->join('faculties', 'faculties.id', '=', 'magazine_issues.faculty_id')
                                    ->where('contributions.is_published','!=','1')
                                    ->where('faculties.id',$facultyId->faculty_id )
                                    ->count();
            
        $datas = [
            'magazineIssueCount' => $magazineIssueCount,
            'studentCount' => $studentCount,
            'contributionsCount' => $contributionsPublishedCount + $contributionsPendingReject,
            'contriPublishCount' => $contributionsPublishedCount,
            'contriPendindRejectCount' => $contributionsPendingReject
        ];
            return view('home',compact('datas'));
        }
        return view('home');
    }
}
