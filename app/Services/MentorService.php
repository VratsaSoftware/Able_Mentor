<?php

namespace App\Services;

use App\Student;

class MentorService
{
    /**
     * @param $mentor
     * @param $otherStudents
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function appropriateStudents($mentor, $otherStudents)
    {
        return Student::with('city', 'mentors', 'projectTypes')
            ->where('season_id', $mentor->current_season_id)
            ->where(function ($q) use ($mentor) {
                $q->doesntHave('mentors')
                    ->orWhereHas('mentors', function ($query) use ($mentor) {
                        $query->where('mentor_id', $mentor->id);
                    });
            })->whereNotIn('id', $otherStudents->pluck('id'))
            ->get();
    }

    public static function inappropriateStudents($mentor)
    {
        return Student::with('city', 'mentors', 'projectTypes')
            ->where('season_id', $mentor->current_season_id)
            ->where(function ($q) use ($mentor) {
                $q->doesntHave('mentors')
                    ->orWhereHas('mentors', function ($query) use ($mentor) {
                        $query->where('mentor_id', $mentor->id);
                    });
            })->whereNotIn('hours', [
                $mentor->hours,
                $mentor->hours - 1,
                $mentor->hours + 1,
            ])->whereNotIn('id', self::studentSpheresAndProj($mentor))
            ->get();
    }

    /**
     * @param $mentor
     * @return \Illuminate\Support\Collection
     */
    public static function studentSpheresAndProj($mentor)
    {
        return Student::with('mentors', 'projectTypes')
            ->where('season_id', $mentor->current_season_id)
            ->where(function ($query) use ($mentor) {
                $query->whereHas('projectTypes', function ($q) use ($mentor) {
                    $q->whereIn('id', $mentor->projectTypes->pluck('id'));
                })->orWhereHas('spheres', function ($q) use ($mentor) {
                    $q->whereIn('id', $mentor->spheres->pluck('id'));
                });
            })->get()
            ->pluck('id');
    }
}
