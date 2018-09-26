<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  protected $fillable = [
    'no_ball_count',
    'wide_ball_count',
    'last_man_standing',
    'unlimited_dismissals',
    'max_balls_per_batter',
    'max_run_per_batter',
    'max_balls_per_over',
    'overs_per_innings',
    'toss_won_by',
    'elected_to'
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'user_id'
  ];
}
