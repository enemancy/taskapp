<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = ['name', 'deadline', 'team_id', 'creater_id', 'completed'];

    public function team(){
        return $this->belongsTo(Team::class, 'team_id');
    }
    public static function getCurrentUserTodos(){
        return Todo::where('creater_id', Auth::user()->id)
            ->orderBy('completed')
            ->orderBy('deadline','asc')
            ->get();
    }
}
