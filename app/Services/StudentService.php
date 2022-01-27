<?php

namespace App\Services;

use App\Mentor;
use App\Season;
use App\Student;

class StudentService
{
    /**
     * @param $student
     * @param $otherMentors
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function appropriateStudents($student, $otherMentors)
    {
        return Mentor::with('city', 'students', 'projectTypes')
            ->where('current_season_id', $student->season_id)
            ->whereNotIn('id', $otherMentors->pluck('id'))
            ->get();
    }

    /**
     * @param $student
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function inappropriateMentors($student)
    {
        return Mentor::with('city', 'students', 'projectTypes')
            ->where('current_season_id', $student->season_id)
            ->whereNotIn('hours', [
                $student->hours,
                $student->hours - 1,
                $student->hours + 1,
            ])->whereNotIn('id', StudentService::mentorSpheresAndProj($student))
            ->get();
    }

    /**
     * @param $mentor
     * @return \Illuminate\Support\Collection
     */
    public static function mentorSpheresAndProj($student)
    {
        return Mentor::with('students', 'projectTypes')
            ->where('current_season_id', $student->season_id)
            ->where(function ($query) use ($student) {
                $query->whereHas('projectTypes', function ($q) use ($student) {
                    $q->whereIn('id', $student->projectTypes->pluck('id'));
                })->orWhereHas('spheres', function ($q) use ($student) {
                    $q->whereIn('id', $student->spheres->pluck('id'));
                });
            })->get()
            ->pluck('id');
    }

    public static function studentStore(\App\Http\Requests\StudentRequest $request)
    {
        $newSeasonId = Season::new()
            ->pluck('id')
            ->first();

        try {
            $request['season_id'] = $newSeasonId;

            $student = new Student($request->all());
            $student->save();

            $student->projectTypes()->attach($request->project_type_ids);
            $student->spheres()->attach($request->spheres);
            $student->sports()->attach($request->sport_ids);
            $student->mentorEducationSphere()->attach($request->mentor_education_ids);
            $student->mentorWorkSphere()->attach($request->mentor_work_sphere_ids);

            $response = ['success' => 'Успешно кандидатстване!'];
        } catch (\Exception $e) {
            $request['error'] = 'Грешка! Моля проверете формата за грешки!';
            $response = $request->all();
        }

        return $response;
    }
}
