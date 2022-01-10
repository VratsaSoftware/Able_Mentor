<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Season;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function pendingApproval()
    {
        if (Auth::user()->isApproved()) {
            return redirect(RouteServiceProvider::HOME);
        } else {
            return view('pendingApproval');
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function archive(Request $request)
    {
        $pastSeasons = Season::past()
            ->orderByDesc('id')
            ->get();

        $students = Student::with(['mentors', 'projectTypes', 'mentors.projectTypes'])
            ->where('season_id', $request->season ?: $pastSeasons->last()->id)
            ->whereHas('mentors')
            ->get();

        return view('archive', [
            'students' => $students,
            'pastSeasons' => $pastSeasons,
        ]);
    }

    /**
     * @param User $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeMode() {
        $oldMode = Auth::user()->mode;
        $newMode = $oldMode ? 0 : 1;

        Auth::user()->mode = $newMode;
        Auth::user()->save();

        return back();
    }
}
