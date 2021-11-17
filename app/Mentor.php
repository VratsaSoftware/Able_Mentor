<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = []; // All are fillable

    public function Gender()
    {
        return $this->belongsTo('App\Gender', 'gender_id', 'id');
    }

    public function City()
    {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function Mentor_Season()
    {
        return $this->belongsTo('App\Mentor_Season', 'season_id', 'id');
    }

    public function Hour()
    {
        return $this->belongsTo('App\Hour', 'hour_id', 'id');
    }

    public function Project_Type()
    {
        return $this->belongsTo('App\Project_Type', 'project_type_id', 'id');
    }
}
