<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFaculty extends Model
{
    protected $table = 'user_faculty';
    protected $fillable = ['faculty_id','user_id'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }
    
    // ! eloquents
    public function getMagazines(){
        $getAuthUserFaculties = \App\UserFaculty::where('user_id',\Auth::user()->id)->select('faculty_id')->get();
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
        return $availableMagazineIssuesWithFaculty;
    }
}
