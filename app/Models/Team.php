<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\TeamMember;
class Team extends Model
{
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function members()
    {
      return $this->hasMany(TeamMember::class);
    }
}
