<?php

namespace App\Http\Controllers;

use App\Partnership;
use Illuminate\Http\Request;

class PartnershipController extends Controller
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
        $partnership = new Partnership;
        $partnership->batsman_one = $request->batsman_one;
        $partnership->batsman_two = $request->batsman_two;
        $partnership->total_runs = $request->total_runs;
        $partnership->total_balls = $request->total_balls;
        $partnership->total_fours = $request->total_fours;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function show(Partnership $partnership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function edit(Partnership $partnership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partnership $partnership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partnership $partnership)
    {
        //
    }
}
