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
        'previous_season_id',
        'current_season_id',
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
     * local scope with relations
     */
    public function scopeWithRelations($query)
    {
        $query->with([
            'city',
            'gender',
            'projectTypes',
            'previousSeason',
        ]);
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function previousSeason()
    {
        return $this->belongsTo(Season::class, 'previous_season_id', 'id');
    }

    public function currentSeason()
    {
        return $this->belongsTo(Season::class, 'current_season_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'mentors_students');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function projectTypes()
    {
        return $this->belongsToMany('App\ProjectType', 'mentors_project_types');
    }
}
