<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'age' => 'required|integer',
            'email' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
            'gender_id' => 'required',
            'school' => 'nullable',
            'class_id' => 'required',
            'favorite_subjects' => 'required',
            'hobbies' => 'required',
            'english_level_id' => 'nullable',
            'sport_id' => 'required',
            'after_school_plans' => 'required',
            'strong_weak_sides' => 'required',
            'qualities_to_change' => 'required',
            'free_time_activities' => 'required',
            'difficult_situations' => 'required',
            'program_achievments' => 'required',
            'want_to_change' => 'required',
            'hours' => 'required',
            'project_type_id' => 'nullable',
            'able_mentor_info_source' => 'required',
            'notes' => 'nullable',
        ];
    }
}
