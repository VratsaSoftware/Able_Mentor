<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = []; // All are fillable

    public function Mentors()
	{
	    return $this->hasMany('App\Mentor', 'gender_id', 'id');
	}
}
