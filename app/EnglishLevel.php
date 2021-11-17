<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnglishLevel extends Model
{
    protected $fillable = []; // All are fillable   

    public function student(){
    	return $this->belongsTo(Student::class);
	}
}
