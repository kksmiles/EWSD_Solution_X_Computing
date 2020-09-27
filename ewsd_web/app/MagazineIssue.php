<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MagazineIssue extends Model
{
    protected $guarded = [];
    protected $table = 'magazine_issues';

    public function faculty()
    {
        return $this->belongsTo('App\Faculty', 'faculty_id', 'id');
    }
    public function academic_year()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id', 'id');
    }
    public function staff()
    {
        return $this->belongsTo('App\User', 'staff_id', 'id');
    }
}
