<?php

namespace App\Services;

use App\Season;

class MentorStudentService {
    /**
     * matching calculation
     *
     * @param $student
     * @param $mentor
     * @return string
     */
    public static function matchingCalculation($student, $mentor) {
        $matchPoints = 0;
        foreach($student->projectTypes as $projectType) {
            if (in_array($projectType->id, $mentor->projectTypes->pluck('id')->toArray())) {
                $matchPoints += 1;

                break;
            }
        }

        if ($student->hours == $mentor->hours) {
            $matchPoints += 1;
        } elseif (in_array($student->hours, [$mentor->hours - 1, $mentor->hours + 1])) {
            $matchPoints += 0.5;
        }

        $matchPercentage = ($matchPoints / 2) * 100;

        return $matchPercentage . '% (' . $matchPoints . ')';
    }

    /**
     * @param $status
     * @param $query
     * @return mixed
     */
    public static function mentorsFilter($status, $query) {
        if ($status == config('consts.MENTOR_STATUS.current_season')) {
            $currentSeasonId = Season::current()
                ->pluck('id')
                ->first();

            $query->where('current_season_id', $currentSeasonId);
        } elseif ($status == config('consts.MENTOR_STATUS.new_season_approved')) {
            $newSeasonId = Season::new()
                ->pluck('id')
                ->first();

            $query->where('current_season_id', $newSeasonId)
                ->whereHas('students');
        } elseif ($status == config('consts.MENTOR_STATUS.new_season_pending')) {
            $newSeasonId = Season::new()
                ->pluck('id')
                ->first();

            $query->where('current_season_id', $newSeasonId)
                ->doesntHave('students');
        } elseif ($status == config('consts.MENTOR_STATUS.archive')) {
            // todo
        } else {
            abort(404);
        }

        return $query;
    }

    /**
     * @param $status
     * @param $query
     * @return mixed
     */
    public static function studentsFilter($status, $query) {
        if ($status == config('consts.STUDENT_STATUS.current_season')) {
            $currentSeasonId = Season::current()
                ->pluck('id')
                ->first();

            $query->where('season_id', $currentSeasonId);
        } elseif ($status == config('consts.STUDENT_STATUS.new_season_approved')) {
            $newSeasonId = Season::new()
                ->pluck('id')
                ->first();

            $query->where('season_id', $newSeasonId)
                ->whereHas('mentors');
        } elseif ($status == config('consts.STUDENT_STATUS.new_season_pending')) {
            $newSeasonId = Season::new()
                ->pluck('id')
                ->first();

            $query->where('season_id', $newSeasonId)
                ->doesntHave('mentors');
        } elseif ($status == config('consts.STUDENT_STATUS.archive')) {
            // todo
        } else {
            abort(404);
        }

        return $query;
    }
}
