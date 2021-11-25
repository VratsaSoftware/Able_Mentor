<?php

namespace App\Services;

use App\City;
use App\EnglishLevel;
use App\Mentor;
use App\ProjectType;
use App\Sport;
use App\Student;
use File;

class ImportDataService {
    public static function importData($fileName, $typeImport)
    {
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
                        self::createMentor($column);
                    } elseif ($typeImport == 'student') {
                        self::createStudent($column);
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

        return $fullPath;
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
    private static function createMentor($column)
    {
        $mentor = Mentor::create([
            'name' => $column[0],
            'age' => $column[1],
            'email' => $column[2],
            'phone' => $column[3],
            'gender_id' => $column[4] == 'Мъж' ? 1 : 2,
            'previous_season_id' => (int)$column[6],
            'city_id' => self::findCity($column[7]),
            'education' => $column[8],
            'work' => $column[9],
            'experience' => $column[10],
            'expertise' => $column[11],
            'difficult_situations' => $column[12],
            'want_to_change' => $column[13],
            'hours' => $column[14],
            'able_mentor_info' => $column[17],
        ]);

        $mentor->projectTypes()->attach(self::findProjectTypes($column[15]));
    }

    /*
     * Create student
     */
    private static function createStudent($column)
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
            'hours' => $column[20],
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
}
