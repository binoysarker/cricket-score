<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TeamMember;

class Batting extends Model
{
    public function teamMember()
    {
      return $this->belongsTo(TeamMember::class);
    }
}
