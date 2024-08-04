<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Todo extends Model
{
    use HasFactory;

    public static function getCurrentUserTodos(){
        return Todo::where('creater_id', Auth::user()->id)->get();
    }
}
