<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Gate;
use DB;
use App\User;
use App\Faculty;

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

        if(is_null($facultyId)){
            return view('home');
        }
         
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
           else if(Gate::allows('isStudent')) {
            $facultiesCount = Auth::user()->faculties->count();
            $contributionsCount = Auth::user()->contributions->count();
            $all_magazine_issues = Auth::user()->student_magazine_issues();
            $publishedContributionsCount = Auth::user()->contributions->where('is_published', 1)->count();
            $magazine_issues = array();
            foreach($all_magazine_issues as $magazine_issue)
            {
                if($magazine_issue->academic_year->isCurrentAcademicYear())
                {
                    array_push($magazine_issues, $magazine_issue);
                }
            }
            $magazineIssueCount = count($magazine_issues);
                
            $datas = [
                'facultiesCount' => $facultiesCount,
                'magazineIssuesCount' => $facultiesCount,
                'contributionsCount' => $contributionsCount,
                'publishedContributionsCount' => $publishedContributionsCount
            ];
            return view('home',compact('datas'));    
        }

        elseif (Gate::allows('isAdmin')) {
            $students = User::where('role_id',4)->count();
            $cooridinators = User::where('role_id',3)->count();
            $managers = User::where('role_id',2)->count();
            $faculties = Faculty::all()->count();

            $new_users = User::latest()->take(5)->get();
            $new_faculties = User::latest()->take(5)->get();
            

            $datas = [ 'students' => $students,
                        'faculties' => $faculties,
                        'cooridinators' => $cooridinators,
                        'managers' => $managers,
                     ];

            return view('home',compact('datas','new_users'));
        } elseif (Gate::allows('isManager')) {
            return redirect()->route('manager.dashboard');
        }
        return view('welcome');
    }
}
