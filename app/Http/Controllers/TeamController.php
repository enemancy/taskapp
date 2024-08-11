<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function myteams(){
        $user = Auth::user();
        $teams = $user->teams;

        return view('myteams', ['teams' => $teams]);
    } 
}
