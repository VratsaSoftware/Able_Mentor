<?php

namespace App\Http\Controllers;

use App\EducationSphere;
use App\Http\Requests\StudentRequest;
use App\Season;
use App\Services\ImportDataService;
use App\Services\MentorStudentService;
use App\Services\StudentService;
use App\Sphere;
use Illuminate\Http\Request;
use App\Student;
use App\City;
use App\Gender;
use App\WhyParticipate;
use App\SchoolClass;
use App\EnglishLevel;
use App\Sport;
use App\ProjectType;
use App\Mentor;
use Illuminate\Support\Facades\Mail;

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
        //dd($studentsQuery->get(), $request->seasonId, $pastSeasons->first()->id);    

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
        $currentSeason = Season::with('cities')
            ->current()
            ->first();

        // if (!$newSeason) {
        //     abort(404);
        // }
        
        return view('students.create', [
            'cities' => $currentSeason->cities,
            'genders' => Gender::all(),
            'schoolClass' => SchoolClass::all(),
            'englishLevels' => EnglishLevel::all(),
            'sports' => Sport::all(),
            'projectTypes' => ProjectType::all(),
            'spheres' => Sphere::where('is_active', true)->get(),
            'educationSpheres' => EducationSphere::all(),
            'whyParticipates' => WhyParticipate::all(),
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
        return redirect()->route('students.create', StudentService::studentStore($request));
    }
    
    public function emailTest()
    {
        $recipientEmail = 'e.kadiyski@gmail.com';
        $data = [];

        // Send email using a view
        Mail::send('emails.successful_registration', $data, function ($message) use ($recipientEmail) {
            $message->to($recipientEmail)
                ->subject('ABLE Mentor | Успешна регистрация');
        });

        return "Email sent successfully!";
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
            'educationSpheres' => EducationSphere::all(),
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
        $student->mentorEducationSpheres()->sync($request->mentor_education_ids);
        $student->mentorWorkSpheres()->sync($request->mentor_work_sphere_ids);

        return redirect()->route('student.show', $student->id)->with('success', 'Успешно редактиран студент!');
    }

    /**
     * @param Student $student
     * @return \Illuminate\View\View
     */
    public function mentors(Student $student)
    {
        $otherMentors = StudentService::inappropriateMentors($student);

        $appropriateMentors = StudentService::appropriateStudents($student, $otherMentors);

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
