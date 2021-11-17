<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\City;
use App\Gender;
use App\SchoolClass;
use App\EnglishLevel;
use App\Sport;
use App\ProjectType;
use App\Hour;
use App\Mentor;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::with('city')
            ->where('is_approved', 1)
            ->get();

        return view('students.list', compact('students'));
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

        return view('students.create', [
            'cities' => $cities,
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
    public function store(Request $request)
    {
        //
    }

    public function show(Student $student)
    {
        $city = City::find($student->city_id);
        $gender = Gender::find($student->gender_id);
        $class = SchoolClass::find($student->class_id);
        $english_level = EnglishLevel::find($student->english_level_id);
        $sport = Sport::find($student->sport_id);
        $project_type = ProjectType::find($student->project_type_id);
        return view('students.single', compact('student', 'city', 'gender', 'class', 'english_level', 'sport', 'project_type'));
    }

    public function delete(Student $student)
    {
        return view('students.delete', compact('student'));
    }

    public function destroy(Student $student)
    {
        $student = Student::find($student);
        $student->each->delete();
        $students = Student::with('city')->where('is_approved', '=', 1)->get();
        return view('students.list', compact('students'));
    }

    public function edit(Student $student)
    {
        $cities = City::all();
        $schoolClasses = SchoolClass::all();
        $englishLevels = EnglishLevel::all();
        $sports = Sport::all();
        $project_types = ProjectType::all();
        return view('students.edit', compact('student', 'cities', 'schoolClasses', 'englishLevels', 'sports', 'project_types'));
    }

    public function update(Request $request, Student $student){
        $student = Student::find($request->studentId);
        $student->name = $request->name;
        $student->name_second = $request->name_second;
        $student->age = $request->age;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->city_id = $request->city;
        $student->school = $request->school;
        $student->class_id = $request->schoolClass;
        $student->favorite_subjects = $request->favorite_subjects;
        $student->hobbies = $request->hobbies;
        $student->english_level_id = $request->englishLevel;
        $student->sport_id = $request->sport;
        $student->after_school_plans = $request->after_school_plans;
        $student->strong_weak_sides = $request->strong_weak_sides;
        $student->qualities_to_change = $request->qualities_to_change;
        $student->free_time_activities = $request->free_time_activities;
        $student->difficult_situations = $request->difficult_situations;
        $student->program_achievments = $request->program_achievments;
        $student->want_to_change = $request->want_to_change;
        $student->hours = $request->hours;
        $student->project_type_id = $request->project_types;
        $student->able_mentor_info_source = $request->able_mentor_info_source;
        $student->notes = $request->notes;
        $student->save();
        $cities = City::all();
        $schoolClasses = SchoolClass::all();
        $englishLevels = EnglishLevel::all();
        $sports = Sport::all();
        $project_types = ProjectType::all();
        return view('students.edit', compact('student', 'cities', 'schoolClasses', 'englishLevels', 'sports', 'project_types'));
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
                $tableCode .= '<tr><td>'. $mentor['name'] . '</td><td>'. $mentor['name_second'] . '</td><td>' . $mentor['city']['name'] . '</td><td>' . $studentsForMentorCount . '</td><td>Свързан</td></tr>';
            } else {
                $tableCode .= '<tr><td>'. $mentor['name'] . '</td><td>'. $mentor['name_second'] . '</td><td>' . $mentor['city']['name'] . '</td><td>' . $studentsForMentorCount . '</td><td><a href="../connect-mentor/' . $student['id'] . '/' . $mentor['id'] . '">Свържи</a></td></tr>';
            }
        }

        $tableCodeType = '';
        foreach ($mentorsType as $mentor) {
            $existsRecord = $mentor->students->contains($student['id']);
            $studentsForMentorCount = $mentor->students->count();
            if ($existsRecord == true){
                $tableCodeType .= '<tr><td>'. $mentor['name'] . '</td><td>'. $mentor['name_second'] . '</td><td>' . $mentor['city']['name'] . '</td><td>' . $studentsForMentorCount . '</td><td>Свързан</td></tr>';
            } else {
                $tableCodeType .= '<tr><td>'. $mentor['name'] . '</td><td>'. $mentor['name_second'] . '</td><td>' . $mentor['city']['name'] . '</td><td>' . $studentsForMentorCount . '</td><td><a href="../connect-mentor/' . $student['id'] . '/' . $mentor['id'] . '">Свържи</a></td></tr>';
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
