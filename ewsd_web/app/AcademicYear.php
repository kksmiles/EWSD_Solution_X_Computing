<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $guarded = [];

    public function magazine_issues()
    {
        return $this->hasMany('App\MagazineIssue');
    }
}
