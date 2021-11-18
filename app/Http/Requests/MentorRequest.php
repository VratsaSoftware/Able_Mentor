<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MentorRequest extends FormRequest
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
            'gender_id' => 'required',
            'phone' => 'required',
            'season' => 'required',
            'city_id' => 'required',
            'work' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'expertise' => 'required',
            'difficult_situations' => 'required',
            'want_to_change' => 'required',
            'hours' => 'required',
            'cv' => ['required', 'file', 'max:20000'],
            'able_mentor_info' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'max' => __('Файлът трябва да бъде по-малък от 20 MB')
        ];
    }
}
