<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
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
      // validation
      $validatedData = $request->validate([
        'no_ball_count' => 'required|numeric',
        'wide_ball_count' => 'required|numeric',
        'last_man_standing' => 'required|numeric',
        'unlimited_dismissals' => 'required|numeric',
        'max_balls_per_batter' => 'required|numeric',
        'max_run_per_batter' => 'required|numeric',
        'max_balls_per_over' => 'required|numeric',
        'overs_per_innings' => 'required|numeric',
        'max_overs_per_bowler' => 'required|numeric',
        'toss_won_by' => 'string',
        'elected_to' => 'string',
      ]);
      // return $request->all();
      if ($validatedData) {
        // return $request->all();
        // check if the user is already have data the table
        $user = Setting::where('user_id',auth()->user()->id)->first();
        if (isset($user)) {
          // now to overwrite the data of the user
          $user->user_id = auth()->user()->id;
          $user->no_ball_count = $request->no_ball_count;
          $user->wide_ball_count = $request->wide_ball_count;
          $user->last_man_standing = $request->last_man_standing;
          $user->unlimited_dismissals = $request->unlimited_dismissals;
          $user->max_balls_per_batter = $request->max_balls_per_batter;
          $user->max_run_per_batter = $request->max_run_per_batter;
          $user->max_balls_per_over = $request->max_balls_per_over;
          $user->overs_per_innings = $request->overs_per_innings;
          $user->max_overs_per_bowler = $request->max_overs_per_bowler;
          $user->save();
        }else {
          // other wise do the normal savings
          // now to save the Database
          $setting = new Setting();
          $setting->user_id = auth()->user()->id;
          $setting->no_ball_count = $request->no_ball_count;
          $setting->wide_ball_count = $request->wide_ball_count;
          $setting->last_man_standing = $request->last_man_standing;
          $setting->unlimited_dismissals = $request->unlimited_dismissals;
          $setting->max_balls_per_batter = $request->max_balls_per_batter;
          $setting->max_run_per_batter = $request->max_run_per_batter;
          $setting->max_balls_per_over = $request->max_balls_per_over;
          $setting->overs_per_innings = $request->overs_per_innings;
          $setting->max_overs_per_bowler = $request->max_overs_per_bowler;
          $setting->save();
        }
      }else {
        $errors = $validator->errors();
        return $errors;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
