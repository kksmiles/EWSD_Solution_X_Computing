<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFaculty extends Model
{
    protected $table = 'user_faculty';

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }
}
