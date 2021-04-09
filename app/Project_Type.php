<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_Type extends Model
{
    protected $fillable = []; // All are fillable

    public function Mentors()
	{
	    return $this->hasMany('App\Mentor', 'project_type_id', 'id');
	}
}
