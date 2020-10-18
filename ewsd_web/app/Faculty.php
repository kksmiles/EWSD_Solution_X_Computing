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
    public function contributions() {
        return $this->hasManyThrough('App\Contributions','App\MagazineIssue','faculty_id','issue_id');
    }
}

