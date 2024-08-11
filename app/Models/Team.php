<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsToMany(User::class, 'users-teams', 'team_id', 'user_id')->using(UserTeam::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'auth_id');
    }

    public static function getCurrentUserTeams(){
        return Team::where('auth_id', auth()->user()->id)->get();
    }

    public function userteam(){
        return $this->belongsTo('App\Models\UserTeam');
    }
}
