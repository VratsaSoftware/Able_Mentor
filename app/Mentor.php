<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = []; // All are fillable    

    public function City()
    {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
}
