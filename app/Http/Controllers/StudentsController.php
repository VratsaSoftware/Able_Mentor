<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Services\ImportDataService;
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

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $studentsQuery = Student::query()
            ->withRelations();

        if ($request->status == 'pending') {
            $studentsQuery->pending();
        } else {
            $studentsQuery->approved();
        }

        $students = $studentsQuery->get();

        return view('students.index', [
            'students' => $students,
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
        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

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
//        return view('students.show', [
//            'student' => $student,
//        ]);
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
    public function update(Student $student, StudentRequest $request) {
        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

        $student->update($data);

        $student->projectTypes()->sync($request->project_type_ids);

        return redirect()->route('students.index')->with('success', 'Успешно редактиран студент!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Student  $student
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function studentApprove(Student $student, Request $request) {
        $student->is_approved = 1;

        $student->save();

        return redirect()->back()->with('success', 'Успешно потвърден студент!');
    }

    public function mentors(Student $student) {
        $appropriateMentors = Mentor::with('city', 'students')
            ->approved()
            ->whereHas('projectTypes', function ($q) use ($student) {
                $q->whereIn('type', $student->projectTypes);
            })->where(function ($q) use ($student) {
                $q->where('hours', $student->hours - 1)
                    ->orWhere('hours', $student->hours)
                    ->orWhere('hours', $student->hours + 1);
            })->get();

        $otherMentors = Mentor::with('city', 'students')
            ->approved()
            ->whereNotIn('id', $appropriateMentors->pluck('id'))
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
    public function importStudents(Request $request) {
        $fileName = Uuid::uuid4() . '.' . $request->file->getClientOriginalExtension();

        $request->file->move(public_path() . '/uploads/csv/', $fileName);

        $fileFailed = ImportDataService::importData($fileName, 'student');

        if (file_exists($fileFailed)) {
            $res = response()->download($fileFailed)->deleteFileAfterSend(true);
        } else {
            $res = redirect()->back()->with('success', 'Успешно импортиран файл със ученици!');
        }

        return $res;
    }

    public function attachMentor(Student $student, Mentor $mentor)
    {
        $student->mentors()->attach($mentor->id);

        return redirect()->back()->with('success', 'Успешно свързване!');
    }

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
