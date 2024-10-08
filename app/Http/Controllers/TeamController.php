<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{   
    public function myteams(){
        $teams = Team::getCurrentUserTeams();

        return view('myteams', ['teams' => $teams]);
    }
    
    public function maketeam(){
        $users = User::getUsersExceptCurrent();
        return view('maketeam', ['users' => $users]);
    }

    public function store(Request $request){
        $teamData=$request['team'];
        $teamData['auth_id']=Auth::user()->id;
        $team=Team::create($teamData);
        $team->user()->attach($request['userIds']);

        return redirect()->route('myTeams');
    }

    public function edit($id, Team $team){
        $team = Team::find($id);
        $users = User::getUsersExceptCurrent();
        $members = $team->user;
        
        return view('editteam', ['team' => $team, 'users' => $users, 'members' => $members]);
    }

    public function update(Request $request, $id){
        $teamData=$request['team'];
        $team = Team::find($id);
        $team->fill($teamData)->save();
        $team->user()->sync($request['userIds']);

        return redirect()->route('myTeams');

    }

    public function delete($id){
        $team = Team::findOrFail($id);
        $team->user()->detach();
        $team->delete();

        return redirect()->route('myTeams');
    }
} 
