<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function contribution()
    {
        return $this->belongsTo('App\Contributions', 'contribution_id', 'id');
    }
}
