<?php

namespace App\Services;

use App\City;
use App\Mentor;
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
                    array_push($dataFailed, $column);
                }
            }

            $rowIndex++;
        }

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

        return $fullPath;
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
        $city = City::where('name', 'like', '%' . $column[7] . '%')
            ->pluck('id')
            ->first();

        Mentor::create([
            'name' => $column[0],
            'age' => $column[1],
            'email' => $column[2],
            'phone' => $column[3],
            'gender_id' => $column[4] == 'Мъж' ? 1 : 2,
            'season' => $column[6],
            'city_id' => $city,
            'education' => $column[8],
            'work' => $column[9],
            'experience' => $column[10],
            'expertise' => $column[11],
            'difficult_situations' => $column[12],
            'want_to_change' => $column[13],
            'hours' => $column[14],
            'able_mentor_info' => $column[15],
        ]);
    }

    /*
     * Create student
     */
    private static function createStudent($column)
    {
        //
    }
}
