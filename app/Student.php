<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'name_second', 'age', 'email', 'phone', 'gender', 'city', 'school', 'class', 'favorite_subjects', 'hobbies', 'english_level', 'sport', 'after_school_plans', 'strong_weak_sides', 'qualities_to_change', 'free_time_activities', 'difficult_situations', 'program_achievments', 'want_to_change', 'hour_id', 'project_type_id', 'able_mentor_info_source', 'notes', 'is_approved',
    ];
}
