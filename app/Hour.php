<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = []; // All are fillable

    public function Mentors()
	{
	    return $this->hasMany('App\Mentor', 'hour_id', 'id');
	}
}
