<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = []; // All are fillable

    public function city(){
    	return $this->hasMany(City::class, 'id', 'city_id');
 	}

    public function mentors()
    {
        return $this->belongsToMany('App\Mentor');
    }
}
