<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 
use DB;

class ReportController extends Controller
{
    function index($year = '2020'){
    // ! Numbers of published and unpublished Contributions    
    $data = DB::table('contributions')
    ->select(
        DB::raw('is_published as is_published'),
        DB::raw('count(*) as number'))
        ->whereYear('created_at', '=', $year)
    ->groupBy('is_published')
    ->get();
        

     $array[] = ['Status', 'Number'];
     foreach($data as $key => $value)
     {
         if($value->is_published == '0'){
            $v = 'Unpublished Contributions';
         }else if($value->is_published == '1'){
            $v = 'Published Contributions';
         }else if($value->is_published == '2'){
            $v = 'Reject Contributions';
         }
        $array[++$key] = [
            $v,
            $value->number
        ];
     }
    
    // ! Numbers of Applications Users 
     $users = DB::table('users')
     ->join('user_roles','user_roles.id','=','users.role_id')
    ->select(
        DB::raw('user_roles.roles as name'),
        DB::raw('count(*) as number'))
        ->groupBy('user_roles.roles')
     ->get();

     $arrayUsers[] = ['Users', 'Number'];
     foreach($users as $key => $value)
     {
        $arrayUsers[++$key] = [
            $value->name,
            $value->number
        ];
     }

     // ! Selected Contributions of each Faculty
     $contributionsOfFaculty =  DB::table('contributions')
                                ->join('magazine_issues', 'magazine_issues.id', '=', 'contributions.issue_id')
                                ->join('faculties', 'faculties.id', '=', 'magazine_issues.faculty_id')
                                ->where('contributions.is_published','1')
                                ->whereYear('contributions.created_at', '=', $year)
                                ->select(
                                    DB::raw('faculties.name as name'),
                                    DB::raw('count(*) as number'))
                                    ->groupBy('faculties.name')
                                ->get();


    $arrayContributionOfFaculty[] = ['ContributionsFaculty', 'Number'];
        foreach($contributionsOfFaculty as $key => $value){
            $arrayContributionOfFaculty[++$key] = [
            $value->name,
            $value->number
            ];
        }
    
    // ! Contributions of each Faculty Per Monthly Yearly
     $contributionsMonthYearly =  DB::table('contributions')
                                ->join('magazine_issues', 'magazine_issues.id', '=', 'contributions.issue_id')
                                ->join('faculties', 'faculties.id', '=', 'magazine_issues.faculty_id')
                                ->whereYear('contributions.created_at', '=', $year)
                                ->select(
                                    DB::raw("MONTH(contributions.created_at) as month"),
                                    DB::raw("YEAR(contributions.created_at) as year"),
                                    DB::raw('count(*) as number'))
                                    ->groupBy('month','year')
                                ->get();

    $arraycontributionsMonthYearly[] = ['Month','Year', 'Number'];
    foreach($contributionsMonthYearly as $key => $value)
    {
        $arraycontributionsMonthYearly[++$key] = [
            $this->calculateMonth($value->month),
            $value->year,
            $value->number
        ];
    }

    // ! Number of students within each Faculty
    $students =  DB::table('users')
                    ->join('user_faculty', 'user_faculty.user_id', '=', 'users.id')
                    ->join('faculties', 'faculties.id', '=', 'user_faculty.faculty_id')
                    ->where('users.role_id','4')
                    ->select(
                        DB::raw('faculties.name as name'),
                        DB::raw('count(*) as students'))
                        ->groupBy('name')
                    ->get();
    $arrayStudents[] = ['Faculty', 'Students'];
        foreach($students as $key => $value)
        {
            $arrayStudents[++$key] = [
                $value->name,
                $value->students
            ];
        }

    // ! Number of contributors within each Faculty
    $contributors =  DB::table('contributions')
                    ->join('users', 'users.id', '=', 'contributions.student_id')
                    ->join('magazine_issues', 'magazine_issues.id', '=', 'contributions.issue_id')
                    ->join('faculties', 'faculties.id', '=', 'magazine_issues.faculty_id')
                    ->where('users.role_id','4')
                    ->whereYear('contributions.created_at', '=', $year)
                    ->select(
                        DB::raw('faculties.name as name'),
                        DB::raw('count(*) as contributors'))
                    ->groupBy('name')
                    ->get();

    $arrayContributors[] = ['Faculty', 'Contributors'];
    foreach($contributors as $key => $value)
        {
            $arrayContributors[++$key] = [
                $value->name,
                $value->contributors
            ];
        }
    // ! Final Data Send To Chart
    $datas = [
        'contributions' => json_encode($array),
        'users' => json_encode($arrayUsers),
        'contributions_faculty' => json_encode($arrayContributionOfFaculty), 
        'contributions_month&yearly' => json_encode($arraycontributionsMonthYearly),
        'students' => json_encode($arrayStudents),
        'contributors' => json_encode($arrayContributors)
    ];

     return view('reports.chart',compact('datas'));
    }

    public function calculateMonth($month){
        switch($month){
            case 1:
                return 'January';
            break;
            case 2:
                return 'February';
            break;
            case 3:
                return 'March';
            break;
            case 4:
                return 'April';
            break;
            case 5:
                return 'May';
            break;
            case 6:
                return 'June';
            break;
            case 7:
                return 'July';
            break;
            case 8:
                return 'August';
            break;
            case 9:
                return 'September';
            break;
            case 10:
                return 'October';
            break;
            case 11:
                return 'November';
            break;
            case 12:
                return 'December';
            break;

        }
    }

    public function contributions(Request $request){
        if (\Request::isMethod('POST')){
            $status = $request->status;
            $acedemicYear = $request->academic_year;
            $contributions = $this->getContributionReportQuery($status,$acedemicYear,'post');
        }else{
            $status = '1';
            $acedemicYear = '1';
            $contributions = $this->getContributionReportQuery($status,$acedemicYear,'get');
        }
        $academics_years = \App\AcademicYear::all();
        return view('reports.report_contribution',compact('contributions','academics_years','status','acedemicYear'));
    }

    public function getContributionReportQuery($status,$acedemicYear,$type){
        $data =  DB::table('contributions')
                ->join('magazine_issues', 'magazine_issues.id', '=', 'contributions.issue_id')
                ->join('faculties', 'faculties.id', '=', 'magazine_issues.faculty_id')
                ->join('academic_years', 'academic_years.id', '=', 'magazine_issues.academic_year_id')
                ->select(
                    'contributions.id as contribution_id',
                    'contributions.title as contribution_title',
                    'contributions.is_published as contribution_status',
                    'contributions.file as contribution_download_file',
                    'magazine_issues.title as magazine_issues_title',
                    'faculties.name as faculty_name',
                    'academic_years.title as academic_year_title',
                );

        if($type != 'post') {
            $query = $data->get();
        } else {
            if($status == 'all' && $acedemicYear != 'all'){
                $query = $data->where('academic_years.id',$acedemicYear)->get();
            }else if($acedemicYear == 'all' && $status != 'all'){
                $query = $data->where('contributions.is_published',$status)->get();
            }else if($status == 'all' && $acedemicYear == 'all'){
                $query = $data->get();
            }
            else{
                $query = $data->where('contributions.is_published',$status)->where('academic_years.id',$acedemicYear)->get();
            }
           
        }
        return $query;
    }

}