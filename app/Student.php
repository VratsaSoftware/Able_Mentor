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
        'town',
        'class_id',
        'season_id',
        'favorite_subjects',
        'hobbies',
        'similar_programs',
        'why_need_able',
        'english_level_id',
        'sport_id',
        'after_school_plans',
        'strong_weak_sides',
        'qualities_to_change',
        'free_time_activities',
        'difficult_situations',
        'why_participate_id',
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
            'mentors',
        ]);
    }

    public function city()
    {
    	return $this->hasOne(City::class, 'id', 'city_id');
 	}

    public function whyParticipate()
    {
        return $this->belongsTo(WhyParticipate::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function englishLevel()
    {
        return $this->belongsTo(EnglishLevel::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
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

    public function spheres()
    {
        return $this->belongsToMany(Sphere::class, 'students_spheres');
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'students_sports');
    }

    public function mentorEducationSpheres()
    {
        return $this->belongsToMany(EducationSphere::class, 'student_mentor_education_sphere');
    }

    public function mentorWorkSpheres()
    {
        return $this->belongsToMany(Sphere::class, 'student_mentor_work_sphere');
    }
}
