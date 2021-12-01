<?php

namespace App\Services;

use App\City;
use App\EnglishLevel;
use App\Mentor;
use App\ProjectType;
use App\Season;
use App\Sport;
use App\Student;
use File;
use Ramsey\Uuid\Uuid;

class ImportDataService {
    /**
     * @param $file
     * @param $typeImport
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public static function importData($file, $seasonStatus, $typeImport, $seasonId = null)
    {
        /* save file */
        $fileName = Uuid::uuid4() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path() . '/uploads/csv/', $fileName);

        $fullPath = public_path('uploads/csv/' . $fileName);

        $file = fopen($fullPath, "r");

        $delimiter = self::detectDelimiter($fullPath);

        $dataFailed = [];

        $rowIndex = 1;
        while (($column = fgetcsv($file, 10000, $delimiter)) !== FALSE)
        {
            if ($rowIndex > 1) {
                try {
                    if ($typeImport == 'mentor') {
                        self::createMentor($column, $seasonStatus, $seasonId);
                    } elseif ($typeImport == 'student') {
                        self::createStudent($column, $seasonStatus, $seasonId);
                    }
                } catch (\Exception $exception) {
                    $column[] = $exception->getMessage();
                    array_push($dataFailed, $column);
                }
            }

            $rowIndex++;
        }

        /* failed data */
        self::failedData($dataFailed, $fullPath);

        if (file_exists($fullPath)) {
            $res = response()->download($fullPath)->deleteFileAfterSend(true);
        } else {
            $res = redirect()->back()->with('success', 'Успешно импортиран файл с Ментори!');
        }

        return $res;
    }

    /*
     * Add failed records to CSV
     */
    private static function failedData($dataFailed, $fullPath) {
        /* failed data */
        if (count($dataFailed)) {
            $fileFailed = fopen($fullPath, 'w');

            fprintf($fileFailed, chr(0xEF).chr(0xBB).chr(0xBF));
            foreach($dataFailed as $review) {
                fputcsv($fileFailed, $review);
            }
            fclose($fileFailed);
        } else {
            /* delete file */
            File::delete($fullPath);
        }
    }

    /*
     * detect delimiter
     */
    public static function detectDelimiter($csvFile)
    {
        $delimiters = array(
            ';' => 0,
             ',' => 0,
             "\t" => 0,
             "|" => 0
        );

        $handle = fopen($csvFile, "r");
        $firstLine = fgets($handle);
        fclose($handle);
        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($firstLine, $delimiter));
        }

        return array_search(max($delimiters), $delimiters);
    }

    /*
     * Create mentor
     */
    private static function createMentor($column, $seasonStatus, $currentSeasonId)
    {
        $seasonId = Season::where('name', $column[6])
            ->pluck('id')
            ->first();

        $mentor = Mentor::create([
            'name' => $column[0],
            'age' => $column[1],
            'email' => $column[2],
            'phone' => $column[3],
            'gender_id' => $column[4] == 'Мъж' ? 1 : 2,
            'previous_season_id' => $seasonId,
            'current_season_id' => $currentSeasonId ?: self::findCurrentSeason($seasonStatus),
            'city_id' => self::findCity($column[7]),
            'education' => $column[8],
            'work' => $column[9],
            'experience' => $column[10],
            'expertise' => $column[11],
            'difficult_situations' => $column[12],
            'want_to_change' => $column[13],
            'hours' => (int)$column[14] ?: 5,
            'able_mentor_info' => $column[17],
        ]);

        $mentor->projectTypes()->attach(self::findProjectTypes($column[15]));
    }

    /*
     * Create student
     */
    private static function createStudent($column, $seasonStatus, $seasonId)
    {
        $englishLevelId = EnglishLevel::where('level', 'like', '%' . $column[11] . '%')
            ->pluck('id')
            ->first();

        $sportId = Sport::where('name', 'like', '%' . $column[12] . '%')
            ->pluck('id')
            ->first();

        $student = Student::create([
            'name' => $column[0],
            'age' => (int)$column[1],
            'email' => $column[2],
            'phone' => $column[3],
            'gender_id' => $column[4] == 'Мъж' ? 1 : 2,
            'city_id' => self::findCity($column[6]),
            'school' => $column[7],
            'class_id' => $column[8],
            'season_id' => $seasonId ?: self::findCurrentSeason($seasonStatus),
            'favorite_subjects' => $column[9],
            'hobbies' => $column[10],
            'english_level_id' => $englishLevelId,
            'sport_id' => $sportId ?: 21,
            'after_school_plans' => $column[13],
            'strong_weak_sides' => $column[14],
            'qualities_to_change' => $column[15],
            'free_time_activities' => $column[16],
            'difficult_situations' => $column[17],
            'program_achievments' => $column[18],
            'want_to_change' => $column[19],
            'hours' => (int)$column[20] ?: 5,
            'able_mentor_info_source' => $column[22],
        ]);

        $student->projectTypes()->attach(self::findProjectTypes($column[21]));
    }

    /*
     * find city
     */
    private static function findCity($city) {
        return City::where('name', 'like', '%' . $city . '%')
            ->pluck('id')
            ->first();
    }

    /*
     * find city
     */
    private static function findProjectTypes($types) {
        $projectTypes = ProjectType::all();

        $projectTypeIds = [];
        foreach ($projectTypes as $projectType) {
            if (strstr($types, $projectType->type) || strstr($types, mb_strtolower($projectType->type, 'UTF-8'))) {
                $projectTypeIds[] = $projectType->id;
            }
        }

        return $projectTypeIds;
    }

    /**
     * @param $seasonStatus
     * @return null | $seasonId
     */
    private static function findCurrentSeason($seasonStatus) {
        $seasonId = null;
        if ($seasonStatus == 'current-season') {
            $seasonId = Season::current()
                ->pluck('id')
                ->first();
        } elseif ($seasonStatus == 'new-season-approved' || $seasonStatus == 'new-season-pending') {
            $seasonId = Season::new()
                ->pluck('id')
                ->first();
        }

        return $seasonId;
    }
}
