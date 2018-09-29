<?php

namespace App\Models;
use App\Models\Team;
use App\Models\Batting;
use App\Models\Bowling;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    public function team()
    {
      return $this->belongsTo(Team::class);
    }
    public function battingInfo()
    {
      return $this->hasMany(Batting::class);
    }
    public function bowlingInfo()
    {
      return $this->hasMany(Bowling::class);
    }
}
