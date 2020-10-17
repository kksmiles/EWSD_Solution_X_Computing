<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';
    protected $guarded = [];

    public function userFaculty() {
        return $this->hasMany('App\UserFaculty');
    }
    public function magazine_issues() {
        return $this->hasMany('App\MagazineIssue', 'faculty_id', 'id');
    }


    public function users()
    {
    	return $this->hasMany('App\User','user_id','faculty_id');
    }

    //Get Short Name of Faculty 
     public function getShortNameAttribute()
    {
        $faculty_name = str_replace("Faculty of ","",$this->name);

        $words = explode(" ", $faculty_name);
        
        $short_name = "";

        foreach ($words as $w) 
        {
          $short_name .= $w[0];
        }

        return $short_name;
    }
}
