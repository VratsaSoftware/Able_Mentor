<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorSeason extends Model
{
    protected $fillable = []; // All are fillable

    public function mentors()
    {
        return $this->hasMany('App\Mentor', 'season_id', 'id');
    }
}
