<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
     protected $fillable = [
        'name', 'name_second', 'age', 'email', 'phone', 'gender', 'season', 'city', 'work', 'experience', 'expertise', 'difficult_situations', 'want_to_change', 'hour_id', 'project_type_id', 'cv_path', 'able_mentor_info', 'notes', 'is_approved',
    ];
}
