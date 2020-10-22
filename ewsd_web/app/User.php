<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'fullname', 'role_id', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function faculties() {
        return $this->belongsToMany('App\Faculty','user_faculty');
    }

    public function role() {
        return $this->belongsTo('App\UserRoles');
    }
    public function student_magazine_issues() {
        $magazine_issues = array();
        foreach($this->faculties as $faculty)
        {
            foreach($faculty->magazine_issues as $magazine_issue)
            {
                array_push($magazine_issues, $magazine_issue);
            }
        }
        return $magazine_issues;
    }
    public function magazine_issues() {
        return $this->hasMany('App\MagazineIssue', 'staff_id', 'id');
    }

    public function contributions() {
        return $this->hasMany('App\Contributions', 'student_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }

    public function getImageURL() {
        return $this->image ? $this->image : '/img/default-profile.svg';
    }
}
