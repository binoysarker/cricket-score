<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('cricket-score','ScoreController')->middleware('auth');
Route::resource('team','TeamController');
Route::resource('team-member','TeamMemberController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('settings','SettingController');
Route::get('battings/get-batting-team-members','BattingController@getBattingTeamMembers');
Route::resource('battings','BattingController');

Route::get('bowlings/get-bowling-team-members','BowlingController@getBowlingTeamMembers');
Route::resource('bowlings','BowlingController');
Route::resource('partnership','PartnershipController');
