<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Season;
use App\Services\ImportDataService;
use App\Services\MentorStudentService;
use Illuminate\Http\Request;
use App\Student;
use App\City;
use App\Gender;
use App\SchoolClass;
use App\EnglishLevel;
use App\Sport;
use App\ProjectType;
use App\Mentor;
use Ramsey\Uuid\Uuid;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $status
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $studentsQuery = Student::query()
            ->withRelations();

        $studentsQuery = MentorStudentService::studentsFilter($status, $studentsQuery);

        return view('students.index', [
            'students' => $studentsQuery->get(),
        ]);
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
     * @param  \App\Http\Requests\StudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $newSeasonId = Season::new()
            ->pluck('id')
            ->first();

        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

        $data['season_id'] = $newSeasonId;

        $student = new Student($data);
        $student->save();

        $student->projectTypes()->attach($request->project_type_ids);

        return redirect()->back()->with('success', 'Успешно се записахте!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student = Student::withRelations()
            ->find($student->id);

        return view('students.show', [
            'student' => $student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
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
     * @param \App\Student  $student
     * @param \App\Http\Requests\StudentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Student $student, StudentRequest $request)
    {
        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

        $student->update($data);

        $student->projectTypes()->sync($request->project_type_ids);

        return redirect()->back()->with('success', 'Успешно редактиран студент!');
    }

    /**
     * @param Student $student
     * @return \Illuminate\View\View
     */
    public function mentors(Student $student)
    {
        $otherMentors = Mentor::with('city', 'students')
            ->where('current_season_id', $student->season_id)
            ->whereNotIn('hours', [
                $student->hours,
                $student->hours - 1,
                $student->hours + 1,
            ])->where(function ($q) use ($student) {
                $q->doesntHave('projectTypes')
                    ->orWhereHas('projectTypes', function ($q) use ($student) {
                        $q->whereNotIn('type', $student->projectTypes);
                    });
            })->get();

        $appropriateMentors = Mentor::with('city', 'students')
            ->where('current_season_id', $student->season_id)
            ->whereNotIn('id', $otherMentors->pluck('id'))
            ->get();

        return view('students.mentors', [
            'student' => $student,
            'appropriateMentors' => $appropriateMentors,
            'otherMentors' => $otherMentors,
        ]);
    }

    /**
     * Import mentors
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importStudents(Request $request)
    {
        $fileName = Uuid::uuid4() . '.' . $request->file->getClientOriginalExtension();

        $request->file->move(public_path() . '/uploads/csv/', $fileName);

        $fileFailed = ImportDataService::importData($fileName, 'student');

        if (file_exists($fileFailed)) {
            $res = response()->download($fileFailed)->deleteFileAfterSend(true);
        } else {
            $res = redirect()->back()->with('success', 'Успешно импортиран файл с ученици!');
        }

        return $res;
    }

    /**
     * Attach a mentor to a student
     *
     * @param  \App\Student  $student
     * @param  \App\Mentor  $mentor
     */
    public function attachMentor(Student $student, Mentor $mentor)
    {
        $student->mentors()->attach($mentor->id);

        return redirect()->back()->with('success', 'Успешно свързване!');
    }

    /**
     * Detach a mentor from a student
     *
     * @param  \App\Student  $student
     * @param  \App\Mentor  $mentor
     */
    public function detachStudentMentor(Student $student, Mentor $mentor)
    {
        $student->mentors()->detach($mentor->id);

        return redirect()->back()->with('success', 'Връзката е премахната!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with('success', 'Успешно изтрит студент!');
    }
}
