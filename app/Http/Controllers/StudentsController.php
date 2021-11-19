<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use App\Student;
use App\City;
use App\Gender;
use App\SchoolClass;
use App\EnglishLevel;
use App\Sport;
use App\ProjectType;
use App\Mentor;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::with(['city', 'gender', 'englishLevel', 'schoolClass', 'sport', 'projectTypes'])
            ->where('is_approved', 1)
            ->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $schoolClass = SchoolClass::all();
        $englishLevels = EnglishLevel::all();
        $sports = Sport::all();
        $projectTypes = ProjectType::all();
        $genders = Gender::all();

        return view('students.create', [
            'cities' => $cities,
            'genders' => $genders,
            'schoolClass' => $schoolClass,
            'englishLevels' => $englishLevels,
            'sports' => $sports,
            'projectTypes' => $projectTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

        $student = new Student($data);
        $student->save();

        $student->projectTypes()->attach($request->project_type_ids);

        return redirect()->back()->with('success', 'Успешно се записахте!');
    }

    public function show(Student $student)
    {
        return view('students.show', [
            'student' => $student,
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with('success', 'Успешно изтрит студент!');
    }

    public function edit(Student $student)
    {
        $cities = City::all();
        $schoolClasses = SchoolClass::all();
        $englishLevels = EnglishLevel::all();
        $sports = Sport::all();
        $projectTypes = ProjectType::all();

        return view('students.edit', [
            'student' => $student,
            'cities' => $cities,
            'schoolClasses' => $schoolClasses,
            'englishLevels' => $englishLevels,
            'sports' => $sports,
            'projectTypes' => $projectTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Student $student, StudentRequest $request) {
        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

        $student->update($data);

        $student->projectTypes()->sync($request->project_type_ids);

        return redirect()->back()->with('success', 'Успешно редактиран студент!');
    }

    public function listAllMentors(Student $student)
    {
        $mentorsType = Mentor::with('city')->where('is_approved', '=', 1)->where('project_type_id', '=', $student->project_type_id)->get();
        $mentors = Mentor::with('city')->where('is_approved', '=', 1)->get();
        $tableCode = '';
        foreach ($mentors as $mentor) {
            $existsRecord = $mentor->students->contains($student['id']);
            $studentsForMentorCount = $mentor->students->count();
            if ($existsRecord == true){
                $tableCode .= '<tr><td>'. $mentor['name'] . '</td><td>' . $mentor['city']['name'] . '</td><td>' . $studentsForMentorCount . '</td><td>Свързан</td></tr>';
            } else {
                $tableCode .= '<tr><td>'. $mentor['name'] . '</td><td>' . $mentor['city']['name'] . '</td><td>' . $studentsForMentorCount . '</td><td><a href="../connect-mentor/' . $student['id'] . '/' . $mentor['id'] . '">Свържи</a></td></tr>';
            }
        }

        $tableCodeType = '';
        foreach ($mentorsType as $mentor) {
            $existsRecord = $mentor->students->contains($student['id']);
            $studentsForMentorCount = $mentor->students->count();
            if ($existsRecord == true){
                $tableCodeType .= '<tr><td>'. $mentor['name'] . '</td><td>' . $mentor['city']['name'] . '</td><td>' . $studentsForMentorCount . '</td><td>Свързан</td></tr>';
            } else {
                $tableCodeType .= '<tr><td>'. $mentor['name'] . '</td><td>' . $mentor['city']['name'] . '</td><td>' . $studentsForMentorCount . '</td><td><a href="../connect-mentor/' . $student['id'] . '/' . $mentor['id'] . '">Свържи</a></td></tr>';
            }
        }
        return view('students.connect', compact('student', 'tableCode', 'tableCodeType'));
    }

    public function connectMentor(Student $student, Mentor $mentor)
    {
        return view('students.mentor', compact('student', 'mentor'));
    }

    public function confirmConnectMentor(Student $student, Mentor $mentor)
    {
        $student->mentors()->attach($mentor->id);
        $students = Student::with('city')->where('is_approved', '=', 1)->get();
        return view('students.list', compact('students'));
    }
}
