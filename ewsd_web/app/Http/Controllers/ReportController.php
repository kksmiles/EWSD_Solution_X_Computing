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
    foreach($contributionsOfFaculty as $key => $value)
    {
        $arrayContributionOfFaculty[++$key] = [
            $value->name,
            $value->number
        ];
    }

    // ! Final Data Send To Chart
    $datas = [
        'contributions' => json_encode($array),
        'users' => json_encode($arrayUsers),
        'contributions_faculty' => json_encode($arrayContributionOfFaculty), 
    ];

     return view('chart.chart',compact('datas'));
    }

}
