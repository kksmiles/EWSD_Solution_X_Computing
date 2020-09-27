<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $guarded = [];
    protected $table = 'academic_years';

    public function magazine_issues()
    {
        return $this->hasMany('App\MagazineIssue', 'academic_year_id', 'id');
    }
}
