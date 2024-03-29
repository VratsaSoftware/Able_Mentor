<?php

namespace App\Http\Controllers;

use App\Http\Requests\MentorRequest;
use App\Season;
use App\Services\ImportDataService;
use App\Services\MentorService;
use App\Services\MentorStudentService;
use App\Services\StudentService;
use App\Sphere;
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

        $mentorsQuery = Mentor::query()
            ->withRelations();

        $mentorsQuery->where('current_season_id', $request->seasonId ?: $pastSeasons->first()->id);

        return view('mentors.index', [
            'mentors' => $mentorsQuery->get(),
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
        $seasons = Season::whereDate('start', '<=', Carbon::now())
            ->get();

        $newSeason = Season::with('cities')
            ->new()
            ->first();

        if (!$newSeason) {
            abort(404);
        }

        return view('mentors.create', [
            'cities' => $newSeason->cities,
            'genders' => Gender::all(),
            'projectTypes' => ProjectType::all(),
            'seasons' => $seasons,
            'spheres' => Sphere::all(),
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

        try {
            $data['current_season_id'] = $newSeasonId;
            $data['cv_path'] = self::saveCV($request->cv);

            $mentor = new Mentor($data);
            $mentor->save();

            $mentor->projectTypes()->attach($request->project_type_ids);
            $mentor->spheres()->attach($request->spheres);

            $response = ['success' => 'Успешно кандидатстване!'];
        } catch (\Exception $e) {
            $request['error'] = 'Грешка! Моля проверете формата за грешки!';
            $response = $request->all();
        }

        return redirect()->route('mentors.create', $response);
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
    public function edit($mentor)
    {
        $mentor = Mentor::with('spheres')
            ->findOrFail($mentor);

        return view('mentors.edit', [
            'mentor' => $mentor,
            'cities' => City::all(),
            'projectTypes' => ProjectType::all(),
            'seasons' => Season::all(),
            'spheres' => Sphere::all(),
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
        if ($request->cv) {
            $request['cv_path'] = self::saveCV($request->cv);
        }

        $mentor->update($request->all());

        $mentor->projectTypes()->sync($request->project_type_ids);
        $mentor->spheres()->sync($request->spheres);

        return redirect()->route('mentor.show', $mentor->id)->with('success', 'Успешно се редактиран ментор!');
    }

    /**
     * @param Mentor $mentor
     * @return \Illuminate\View\View
     */
    public function students(Mentor $mentor)
    {
        $otherStudents = MentorService::inappropriateStudents($mentor);

        $appropriateStudents = MentorService::appropriateStudents($mentor, $otherStudents);

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
        return ImportDataService::importData($request->file, $request->seasonStatus, 'mentor', $request->seasonId);
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
