<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable = []; // All are fillable

    public function mentors()
	{
	    return $this->hasMany('App\Mentor', 'hour_id', 'id');
	}
}
