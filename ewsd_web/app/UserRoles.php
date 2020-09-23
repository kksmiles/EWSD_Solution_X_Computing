<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';
    protected $fillable = ['roles'];
    public function users()
    {
        return $this->hasMany('App\User');
    }
}