<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    function index($year = '2020')
    {
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


    // ! Final Data Send To Chart
    $datas = [
        'contributions' => json_encode($array),
        'users' => json_encode($arrayUsers),
        'contributions_faculty' => json_encode($arrayContributionOfFaculty), 
        'contributions_month&yearly' => json_encode($arraycontributionsMonthYearly)
    ];

     return view('chart.chart',compact('datas'));
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

}