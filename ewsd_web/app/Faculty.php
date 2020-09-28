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
}
