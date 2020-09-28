<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFaculty extends Model
{
    protected $table = 'user_faculty';
    protected $fillable = ['faculty_id','user_id'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }
}
