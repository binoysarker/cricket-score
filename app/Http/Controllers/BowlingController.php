<?php

namespace App\Http\Controllers;

use App\Models\Bowling;
use Illuminate\Http\Request;

class BowlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // get the last two rows from the battings table
      $bowling = Bowling::orderBy('id','desc')->first();
      return $bowling;
    }
    /**
     * getBowlingTeamMembers
     */
     public function getBowlingTeamMembers()
     {
       // get the last row from the bowllings table
       $bowling = Bowling::orderBy('id','desc')->first();

       // foreach ($bowling as $value) {
       //   $teamMembers[] = $value->teamMember;
       // }
       return $bowling->teamMember;

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
        $bowling = Bowling::all()->last();
        $bowling->overs = $request->overs;
        $bowling->maiden_overs = $request->maiden_overs;
        $bowling->runs_given = $request->runs_given;
        $bowling->no_ball = $request->no_ball;
        $bowling->wide_ball = $request->wide_ball;
        $bowling->leg_bye = $request->leg_bye;
        $bowling->bye = $request->bye;
        $bowling->wicket_taken = $request->wicket_taken;
        $bowling->save();
        return $bowling;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bowling  $bowling
     * @return \Illuminate\Http\Response
     */
    public function show(Bowling $bowling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bowling  $bowling
     * @return \Illuminate\Http\Response
     */
    public function edit(Bowling $bowling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bowling  $bowling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bowling $bowling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bowling  $bowling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bowling $bowling)
    {
        //
    }
}
