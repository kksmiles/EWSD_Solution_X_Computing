<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AcademicYear extends Model
{
    protected $guarded = [];
    protected $table = 'academic_years';

    public function magazine_issues()
    {
        return $this->hasMany('App\MagazineIssue', 'academic_year_id', 'id');
    }
    public function isCurrentAcademicYear() {
        $now = Carbon::now();
        return ($this->closure_date > $now);
    }
}
