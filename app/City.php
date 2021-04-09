<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = []; // All are fillable

    public function Mentors()
	{
	    return $this->hasMany('App\Mentor', 'city_id', 'id');
	}
}
