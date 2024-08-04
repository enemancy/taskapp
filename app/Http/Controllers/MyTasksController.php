<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class MyTasksController extends Controller
{
    public function mytasks(Todo $todo){
        return view('mytasks', ['todos' => $todo->get()]);
    } 

    public function updateStatus(Todo $todo){
        $completed = request()->input('completed');
        $todo->update(['completed' => $completed]);

        return response()->json(['success' => true]);
    }
    
}

