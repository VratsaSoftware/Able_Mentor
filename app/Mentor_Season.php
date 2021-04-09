<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor_Season extends Model
{
    protected $fillable = []; // All are fillable

    public function Mentors()
	{
	    return $this->hasMany('App\Mentor', 'season_id', 'id');
	}
}
