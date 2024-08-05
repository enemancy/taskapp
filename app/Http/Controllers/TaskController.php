<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TaskController extends Controller
{
    public function mytasks(Todo $todo){
        return view('mytasks', ['todos' => $todo->getCurrentUserTodos()]);
    } 

    public function updateStatus(Todo $todo){
        $completed = request()->input('completed');
        $todo->update(['completed' => $completed]);

        return response()->json(['success' => true]);
    }

    public function store(Request $request, Todo $todo){
        $input = $request['task'];
        $input['creater_id'] = auth()->id();
        $todo->fill($input)->save();

        return redirect()->route('mytasks');
    }
    
}
