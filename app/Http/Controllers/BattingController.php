<?php

namespace App\Http\Controllers;

use App\Models\Batting;
use Illuminate\Http\Request;

class BattingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // get the last two rows from the battings table
      $batting = Batting::orderBy('id','desc')->limit(2)->get();
      return $batting;
    }
    /**
    * getBattingTeamMembers
    */
    public function getBattingTeamMembers()
    {
      // return $id;
      // get the last two rows from the battings table
      $batting = Batting::orderBy('id','desc')->limit(2)->get();
      foreach ($batting as $value) {
        $getAllTeamMember[] = $value->teamMember;
      }
      return $getAllTeamMember;
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
        // return $request->all();
        if ($request->batter_runs == 4) {
          $batting = Batting::find($request->batter_id);
          $batting->runs += $request->batter_runs;
          $batting->balls = $request->batter_balls;
          $batting->fours += 1;
          $batting->save();
          return $batting;
        }
        else if ($request->batter_runs == 6) {
          $batting = Batting::find($request->batter_id);
          $batting->runs += $request->batter_runs;
          $batting->balls = $request->batter_balls;
          $batting->sixes += 1;
          $batting->save();
          return $batting;
        }
        else if ($request->batter_runs == 'no_ball' || $request->batter_runs == 'wide_ball' || $request->batter_runs == 'leg_bye' || $request->batter_runs == 'bye' || $request->batter_runs == 'wicket_taken') {
          return $request->batter_runs;
        }
        else {
          $batting = Batting::find($request->batter_id);
          $batting->runs += $request->batter_runs;
          $batting->balls = $request->batter_balls;
          $batting->save();
          return $batting;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batting  $batting
     * @return \Illuminate\Http\Response
     */
    public function show(Batting $batting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batting  $batting
     * @return \Illuminate\Http\Response
     */
    public function edit(Batting $batting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batting  $batting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batting $batting)
    {
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batting  $batting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batting $batting)
    {
        //
    }
}
