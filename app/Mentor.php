<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = [
        'name',
        'age',
        'email',
        'gender_id',
        'phone',
        'season',
        'city_id',
        'work',
        'education',
        'experience',
        'expertise',
        'difficult_situations',
        'want_to_change',
        'hours',
        'cv_path',
        'able_mentor_info',
        'notes',
    ];

    /*
     * local scope approved
     */
    public function scopeApproved($query)
    {
        $query->where('is_approved', 1);
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student', 'mentors_students');
    }

    public function projectTypes()
    {
        return $this->belongsToMany('App\ProjectType', 'mentors_project_types');
    }
}
