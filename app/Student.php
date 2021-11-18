<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'age',
        'email',
        'phone',
        'city_id',
        'gender_id',
        'school',
        'class_id',
        'favorite_subjects',
        'hobbies',
        'english_level_id',
        'sport_id',
        'after_school_plans',
        'strong_weak_sides',
        'qualities_to_change',
        'free_time_activities',
        'difficult_situations',
        'program_achievments',
        'want_to_change',
        'hours',
        'project_type_id',
        'able_mentor_info_source',
        'notes',
    ];

    public function city(){
    	return $this->hasMany(City::class, 'id', 'city_id');
 	}

    public function mentors()
    {
        return $this->belongsToMany('App\Mentor', 'mentors_students');
    }

    public function projectTypes()
    {
        return $this->belongsToMany('App\ProjectType', 'students_project_types');
    }
}
