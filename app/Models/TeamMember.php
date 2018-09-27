<?php

namespace App\Models;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    public function team()
    {
      return $this->belongsTo(Team::class);
    }
}
