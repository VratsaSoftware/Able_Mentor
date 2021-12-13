<?php

namespace App\Http\Controllers;

use App\City;
use App\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = Season::with('cities')
            ->where('id', '!=', 1)
            ->get();

        $newOpenSeasonId = Season::new()
            ->pluck('id')
            ->first();

        return view('seasons.index', [
            'seasons' => $seasons,
            'newOpenSeasonId' => $newOpenSeasonId,
            'cities' => City::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $season = new Season;

        $season->name = $request->name;
        $season->start = $request->start;
        $season->end = $request->end;
        $season->save();

        $season->cities()->attach($request->cities);

        return redirect()->back()->with('success', 'Успешно създаден сезон!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        $season->delete();

        return redirect()->back()->with('success', 'Успешно изтрит сезон!');
    }
}
