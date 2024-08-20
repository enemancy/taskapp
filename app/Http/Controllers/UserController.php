<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function searchFromEmail($email)
    {
        $user = User::where('email', $email)->first();
        return response()->json($user);
    }

    public function suggest($query){
        $users = User::where('email', 'like', "%{$query}%")->get();
        $users = $users->map(function ($user) {
            $user->suggest = "{$user->name}({$user->email})";
            return $user;
        });
        return response()->json($users);
    }
}
