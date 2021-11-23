<?php

namespace App\Http\Controllers;

use App\Http\Requests\MentorRequest;
use App\Services\ImportDataService;
use Illuminate\Http\Request;
use App\Mentor;
use App\City;
use App\Gender;
use App\ProjectType;
use App\Student;
use Ramsey\Uuid\Uuid;

class MentorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$mentorsQuery = Mentor::query()
            ->withRelations();

    	if ($request->status == 'pending') {
            $mentorsQuery->pending();
        } else {
            $mentorsQuery->approved();
        }

        $mentors = $mentorsQuery->get();

        return view('mentors.index', [
            'mentors' => $mentors,
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
        $projectTypes = ProjectType::all();
        $genders = Gender::all();

        return view('mentors.create', [
            'cities' => $cities,
            'genders' => $genders,
            'projectTypes' => $projectTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MentorRequest $request)
    {
        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

        $data['cv_path'] = self::saveCV($request->cv);

        $mentor = new Mentor($data);
        $mentor->save();

        $mentor->projectTypes()->attach($request->project_type_ids);

        return redirect()->back()->with('success', 'Успешно се записахте!');
    }

    /* save cv */
    private static function saveCV($cvFile) {
        $cvName = Uuid::uuid4() . '.' . $cvFile->getClientOriginalExtension();

        $cvFile->move(public_path() . '/cv/', $cvName);

        return $cvName;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Mentor $mentor)
    {
//        $gender = Gender::find($mentor->gender_id);
//        $city = City::find($mentor->city_id);
//        $project_type = ProjectType::find($mentor->project_type_id);
//
//        return view('mentors.single', compact('mentor', 'gender', 'city', 'project_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Mentor $mentor)
    {
        $cities = City::all();
        $projectTypes = ProjectType::all();

        return view('mentors.edit', [
            'mentor' => $mentor,
            'cities' => $cities,
            'projectTypes' => $projectTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\StudentRequest  $request
     * @param \App\Mentor  $mentor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MentorRequest $request, Mentor $mentor)
    {
        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

        if ($request->cv) {
            $data['cv_path'] = self::saveCV($request->cv);
        }

        $mentor->update($data);

        $mentor->projectTypes()->attach($request->project_type_ids);

        return redirect()->back()->with('success', 'Успешно се записахте!');
    }

    public function students(Mentor $mentor)
    {
        $appropriateStudents = Student::with('city', 'mentors')
            ->approved()
            ->where(function ($q) use ($mentor) {
                $q->doesntHave('mentors')
                    ->orWhereHas('mentors', function ($query) use ($mentor) {
                        $query->where('mentor_id', $mentor->id);
                    });
            })->where(function ($q) use ($mentor) {
                $q->where('hours', $mentor->hours - 1)
                    ->orWhere('hours', $mentor->hours)
                    ->orWhere('hours', $mentor->hours + 1);
            })
            ->whereHas('projectTypes', function ($q) use ($mentor) {
                $q->whereIn('type', $mentor->projectTypes);
            })->get();

        $otherStudents = Student::with('city', 'mentors')
            ->approved()
            ->where(function ($q) use ($mentor) {
                $q->doesntHave('mentors')
                    ->orWhereHas('mentors', function ($query) use ($mentor) {
                        $query->where('mentor_id', $mentor->id);
                    });
            })->whereNotIn('id', $appropriateStudents->pluck('id'))
            ->get();

        return view('mentors.students', [
            'mentor' => $mentor,
            'appropriateStudents' => $appropriateStudents,
            'otherStudents' => $otherStudents,
        ]);
    }

    /**
     * Import mentors
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importMentors(Request $request) {

        $fileName = Uuid::uuid4() . '.' . $request->file->getClientOriginalExtension();

        $request->file->move(public_path() . '/uploads/csv/', $fileName);

        $fileFailed = ImportDataService::importData($fileName, 'mentor');

        if (file_exists($fileFailed)) {
            $res = response()->download($fileFailed)->deleteFileAfterSend(true);
        } else {
            $res = redirect()->back()->with('success', 'Успешно импортиран файл с Ментори!');
        }

        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mentor $mentor)
    {
        $mentor->delete();

        return back()->with('success', 'Успешно изтрит ментор!');
    }
}
