<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $validatedData = $request->validate([
          'member_name' => 'required|string|unique:team_members'
        ]);
        if ($validatedData) {
          // get team_id and user_id from the team teable and store in the team_members table
          $team = Team::where([
            'user_id' => auth()->user()->id,
            'name' => $request->team_name
            ])->first(['id','user_id','name']);
            // return $team->name;
            $teamMember = TeamMember::where([
              'user_id'=> $team->user_id,
              'team_id' => $team->id,
              'member_name' => $request->member_name
              ])->get();
            if (count($teamMember) > 0) {
              // update the data
              $teamMember = TeamMember::where([
                'user_id'=> $team->user_id,
                'team_id' => $team->id,
                'member_name' => $request->member_name
                ])->update([
                'user_id'=> $team->user_id,
                'team_id' => $team->id,
                'member_name' => $request->member_name
              ]);
            }else {
              // save the new data
              $teamMember = new TeamMember();
              $teamMember->user_id = $team->user_id;
              $teamMember->team_id = $team->id;
              $teamMember->member_name = $request->member_name;
              $teamMember->save();
              // flash message
              return response()->json(['status'=>'member is created']);
            }
            // now get the team member with their team info
            // $getAllTeamMember = TeamMember::where('user_id',$team->user_id)->get();
            // return $getAllTeamMember;
        }else {
          $errors = $validator->errors();
          return $errors;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show($teamName)
    {
      // now to get the team_members according to the team name
      $getName = Team::where('name',$teamName)->first();
      // return $getName;
      $teamMemers = Team::find($getName->id)->members;
      // $teamMemers = $teams->with('members');
      return $teamMemers;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamMember $teamMember)
    {
      if ($request->picked_name) {
        if ($teamMember->selected == 0) {
          $teamMember->selected = 1;
          $teamMember->save();
          // return $teamMember->selected;
        }else if ($teamMember->selected == 1) {
          $teamMember->selected = 0;
          $teamMember->save();
          // return $teamMember->selected;
        }
      }
      else if ($request->strike_batter) {
        $teamMember->selected_to = 'strike_batter';
        $teamMember->save();
      }
      else if ($request->non_strike_batter) {
        $teamMember->selected_to = 'non_strike_batter';
        $teamMember->save();
      }
      else if ($request->bowler_selected) {
        $teamMember->selected_to = 'bowler_selected';
        $teamMember->save();
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teamMember)
    {
        //
    }
}
