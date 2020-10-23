<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Collection;

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
    public function contributions() {
        return $this->hasMany('App\Contributions', 'issue_id', 'id');
    }
    public function getImageURL() {
        return $this->image ? $this->image : '/img/default-picture.svg';
    }
}
