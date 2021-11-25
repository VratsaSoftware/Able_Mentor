<?php

namespace App\Services;

class MentorStudentService {
    public static function matchingCalculation($student, $mentor) {
        $matchPoints = 0;
        foreach($student->projectTypes as $projectType) {
            if (in_array($projectType->id, $mentor->projectTypes->pluck('id')->toArray())) {
                $matchPoints += 1;
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
}
