<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTeam extends Pivot
{
    protected $table = 'users-teams';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }
}
