<?php

namespace App\Http\Controllers;

use App\Http\Requests\MentorRequest;
use App\Season;
use App\Services\ImportDataService;
use App\Services\MentorStudentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mentor;
use App\City;
use App\Gender;
use App\ProjectType;
use App\Student;
use Ramsey\Uuid\Uuid;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param null $status
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
    	$mentorsQuery = Mentor::query()
            ->withRelations();

        $mentorsQuery = MentorStudentService::mentorsFilter($status, $mentorsQuery);

        return view('mentors.index', [
            'mentors' => $mentorsQuery->get(),
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
        $seasons = Season::whereDate('start', '<=', Carbon::now())
            ->get();

        return view('mentors.create', [
            'cities' => $cities,
            'genders' => $genders,
            'projectTypes' => $projectTypes,
            'seasons' => $seasons,
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
        $newSeasonId = Season::new()
            ->pluck('id')
            ->first();

        $data = $request->all();

        unset($data['_token']);
        unset($data['project_type_ids']);

        $data['current_season_id'] = $newSeasonId;
        $data['cv_path'] = self::saveCV($request->cv);

        $mentor = new Mentor($data);
        $mentor->save();

        $mentor->projectTypes()->attach($request->project_type_ids);

        return redirect()->back()->with('success', 'Успешно се записахте!');
    }

    /**
     * Save cv file
     *
     * @param $cvFile
     * @return string
     */
    private static function saveCV($cvFile)
    {
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
        $mentor = Mentor::withRelations()
            ->find($mentor->id);

        return view('mentors.show', [
            'mentor' => $mentor,
        ]);
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
        $seasons = Season::all();

        return view('mentors.edit', [
            'mentor' => $mentor,
            'cities' => $cities,
            'projectTypes' => $projectTypes,
            'seasons' => $seasons,
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

        $mentor->projectTypes()->sync($request->project_type_ids);

        return redirect()->route('mentor.show', $mentor->id)->with('success', 'Успешно се редактиран ментор!');
    }

    /**
     * @param Mentor $mentor
     * @return \Illuminate\View\View
     */
    public function students(Mentor $mentor)
    {
        $otherStudents = Student::with('city', 'mentors', 'projectTypes')
            ->where('season_id', $mentor->current_season_id)
            ->where(function ($q) use ($mentor) {
                $q->doesntHave('mentors')
                    ->orWhereHas('mentors', function ($query) use ($mentor) {
                        $query->where('mentor_id', $mentor->id);
                    });
            })->whereNotIn('hours', [
                $mentor->hours,
                $mentor->hours - 1,
                $mentor->hours + 1,
            ])->where(function ($q) use ($mentor) {
                $q->doesntHave('projectTypes')
                    ->orWhereHas('projectTypes', function ($q) use ($mentor) {
                        $q->whereNotIn('type', $mentor->projectTypes);
                    });
            })->get();

        $appropriateStudents = Student::with('city', 'mentors', 'projectTypes')
            ->where('season_id', $mentor->current_season_id)
            ->where(function ($q) use ($mentor) {
                $q->doesntHave('mentors')
                    ->orWhereHas('mentors', function ($query) use ($mentor) {
                        $query->where('mentor_id', $mentor->id);
                    });
            })->whereNotIn('id', $otherStudents->pluck('id'))
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
    public function importMentors(Request $request)
    {
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
