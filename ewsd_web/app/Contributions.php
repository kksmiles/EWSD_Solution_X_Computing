<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributions extends Model
{
    protected $guarded = [];
    protected $table = 'contributions';

    public function student()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }

    public function magazineIssue()
    {
        return $this->belongsTo('App\MagazineIssue', 'issue_id', 'id');
    }

    public function getOnlyAuthContributions(){
        $getContributions = \App\Contributions::where('student_id',\Auth::user()->id)->get();
        return $getContributions;
    }
}
