<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function myteams(){
        $user = Auth::user();
        $teams = $user->teams;

        return view('myteams', ['teams' => $teams]);
    }
    
    public function maketeam(){
        $currentUser = Auth::user();
        $users = User::where('id', '!=', $currentUser->id)->get();
        return view('maketeam', ['users' => $users]);
    }

    public function store(Request $request){
        $teamData=$request['team'];
        $teamData['auth_id']=Auth::user()->id;
        $team=Team::create($teamData);
        $team->user()->attach($request['userIds']);
        $team->user()->attach(Auth::user()->id);

        return redirect()->route('myTeams');
    }
} 
