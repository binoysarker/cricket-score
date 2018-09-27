<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $team = Team::all();
      return $team;
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
      // return $request->TeamA;
      // now to check where is the teamA and teamB in the database
      if (isset($request->TeamA) && isset($request->TeamB)) {
        $getTeamA = Team::where('name',$request->TeamA)->first();
        $getTeamB = Team::where('name',$request->TeamB)->first();
        $getTeamA->verses = $request->TeamB;
        $getTeamB->verses = $request->TeamA;
        $getTeamA->save();
        $getTeamB->save();
        // return $getTeamA;

      }
      if (isset($request->name)) {
        // validation
        $validatedData = $request->validate([
          'name' => 'required|unique:teams|max:255'
        ]);
        if ($validatedData) {

          // save the data in the teams table
          $team = new Team();
          $team->user_id = auth()->user()->id;
          $team->name = $request->name;
          $team->save();

          // return $team;
        }else {
          $errors = $validator->errors();
          return $errors;
        }
      }

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        // return $team->user_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
