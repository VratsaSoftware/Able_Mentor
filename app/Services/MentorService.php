<?php

namespace App\Services;

use App\Mentor;
use App\Season;
use App\Student;
use Ramsey\Uuid\Uuid;

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

    /**
     * @param $request
     * @return array|string[]
     */
    public static function storeMentor($request)
    {
        $newSeasonId = Season::new()
            ->pluck('id')
            ->first();

        $data = $request->all();

        try {
            $data['current_season_id'] = $newSeasonId;
            $data['cv_path'] = self::saveCV($request->cv);

            $mentor = new Mentor($data);
            $mentor->save();

            $mentor->projectTypes()->attach($request->project_type_ids);
            $mentor->spheres()->attach($request->spheres);
            $mentor->educationSpheres()->attach($request->education_sphere_ids);
            $mentor->workSpheres()->attach($request->work_sphere_ids);

            $response = ['success' => 'Успешно кандидатстване!'];
        } catch (\Exception $e) {
            $request['error'] = 'Грешка! Моля проверете формата за грешки!';
            $response = $request->all();
        }

        return $response;
    }

    /**
     * Save cv file
     *
     * @param $cvFile
     * @return string
     */
    private static function saveCV($cvFile)
    {
        $cvName = Uuid::uuid4() . '.' . $cvFile->getClientOriginalExtension();

        $cvFile->move(public_path() . '/cv/', $cvName);

        return $cvName;
    }

}
