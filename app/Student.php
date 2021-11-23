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
        'able_mentor_info_source',
        'notes',
    ];

    /*
     * local scope with relations
     */
    public function scopeWithRelations($query)
    {
        $query->with([
            'city',
            'gender',
            'englishLevel',
            'schoolClass',
            'sport',
            'projectTypes',
        ]);
    }

    /*
     * local scope approved
     */
    public function scopeApproved($query)
    {
        $query->where('is_approved', 1);
    }

    /*
     * local scope pending
     */
    public function scopePending($query)
    {
        $query->where('is_approved', 0);
    }

    public function city()
    {
    	return $this->hasOne(City::class, 'id', 'city_id');
 	}

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function englishLevel()
    {
        return $this->belongsTo(EnglishLevel::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class,'class_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
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
