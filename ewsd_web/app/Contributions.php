<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class Contributions extends Model
{
    protected $guarded = [];
    protected $table = 'contributions';

    public function student()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }
    public function faculty()
    {
        return $this->magazineIssue->faculty;
    }
    public function magazineIssue()
    {
        return $this->belongsTo('App\MagazineIssue', 'issue_id', 'id');
    }
    
    public function getOnlyAuthContributions(){
        $getContributions = \App\Contributions::where('student_id',\Auth::user()->id)->get();
        return $getContributions;
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'contribution_id', 'id');
    }
    public function isOpen()
    {
        $modification_closure_date = $this->magazineIssue->modification_closure_date;
        $now = Carbon::now();
        $submitted_time = $this->created_at;
        $day_diff = $submitted_time->diffInDays($now);

        if($now > $modification_closure_date) {
            session(['closed' => 'It is now past closure date']);
            return false; // Closed contribution if current time is later than closure date
        } else if ($this->is_published == 2) {
            session(['closed' => "You've been rejected"]);
            return false;
        } else if ($day_diff >= 14) {
            if ($this->comments->isEmpty()) {
                session(['closed' => "You've been automatically rejected"]);
                return false; // Closed Contribution if comments is empty after 14 days.
            } else {
                return true; // Open contribution if there is comment after 14 days.
            }
        } else {
            return true; // Open contribution if it hasn't been 14 days.
        }
    }
    public function allowComment() 
    {
        $user = Auth::user();
        if($this->isOpen()) // Check if the contribution is still open or not
        {
            if ($user->role_id == 3) {
                return true; // Allow coordinator to comment
            } else if ($this->comments->isEmpty()) {
                return false; // Doesn't allow students to comment if there hasn't been any comment from coordinator.
            } else {
                return true; // Allow students to comment if there is a commetn from coordinator.
            }
        } else {
            return false; // Doesn't allow comment if the contribution is closed.
        }
    }
}
