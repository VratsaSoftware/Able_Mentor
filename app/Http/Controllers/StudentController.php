<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Season;
use App\Services\ImportDataService;
use App\Services\MentorStudentService;
use App\Sphere;
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
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request)
    {
        $pastSeasons = Season::past()
            ->orderByDesc('id')
            ->get();

        $studentsQuery = Student::query()
            ->withRelations();

        $studentsQuery->where('season_id', $request->seasonId ?: $pastSeasons->first()->id);

        return view('students.index', [
            'students' => $studentsQuery->get(),
            'pastSeasons' => $pastSeasons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newSeason = Season::with('cities')
            ->new()
            ->first();

        if (!$newSeason) {
            abort(404);
        }

        return view('students.create', [
            'cities' => $newSeason->cities,
            'genders' => Gender::all(),
            'schoolClass' => SchoolClass::all(),
            'englishLevels' => EnglishLevel::all(),
            'sports' => Sport::all(),
            'projectTypes' => ProjectType::all(),
            'spheres' => Sphere::all(),
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

        try {
            $request['season_id'] = $newSeasonId;

            $student = new Student($request->all());
            $student->save();

            $student->projectTypes()->attach($request->project_type_ids);
            $student->spheres()->attach($request->spheres);
            $student->sports()->attach($request->sport_ids);

            $response = ['success' => 'Успешно кандидатстване!'];
        } catch (\Exception $e) {
            $request['error'] = 'Грешка! Моля проверете формата за грешки!';
            $response = $request->all();
        }

        return redirect()->route('students.create', $response);
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
        return view('students.edit', [
            'student' => $student,
            'cities' => City::all(),
            'schoolClasses' => SchoolClass::all(),
            'englishLevels' => EnglishLevel::all(),
            'sports' => Sport::all(),
            'spheres' => Sphere::all(),
            'projectTypes' => ProjectType::all(),
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
        $student->update($request->all());

        $student->projectTypes()->sync($request->project_type_ids);
        $student->spheres()->sync($request->spheres);
        $student->sports()->sync($request->sport_ids);

        return redirect()->route('student.show', $student->id)->with('success', 'Успешно редактиран студент!');
    }

    /**
     * @param Student $student
     * @return \Illuminate\View\View
     */
    public function mentors(Student $student)
    {
        $otherMentors = Mentor::with('city', 'students', 'projectTypes')
            ->where('current_season_id', $student->season_id)
            ->where(function ($q) use ($student) {
                $q->whereNotIn('hours', [
                    $student->hours,
                    $student->hours - 1,
                    $student->hours + 1,
                ])->orWhere(function ($query) use ($student) {
                    $query->doesntHave('projectTypes')
                        ->orWhereHas('projectTypes', function ($q) use ($student) {
                            $q->whereNotIn('id', $student->projectTypes->pluck('id'));
                        });
                })->orWhere(function ($query) use ($student) {
                    $query->doesntHave('spheres')
                        ->orWhereHas('spheres', function ($q) use ($student) {
                            $q->whereNotIn('id', $student->spheres->pluck('id'));
                        });
                });
            })->get();

        $appropriateMentors = Mentor::with('city', 'students', 'projectTypes')
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
        return ImportDataService::importData($request->file, $request->seasonStatus, 'student', $request->seasonId);
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
