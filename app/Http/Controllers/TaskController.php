<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TaskController extends Controller
{
    //MyTasks
    public function mytasks(Todo $todo){
        return view('mytasks', ['todos' => $todo->getCurrentUserTodos()]);
    } 

    public function updateStatus(Request $request, $id){
        $todo = Todo::findOrFail($id);
        $completed = request()->input('completed');
        $todo->update(['completed' => $completed]);

        return response()->json(['success' => true]);
    }

    //MakeTask
    public function store(Request $request, Todo $todo){
        $input = $request['task'];
        $input['creater_id'] = auth()->id();
        $todo->fill($input)->save();

        return redirect()->route('myTasks');
    }

    //EditTask
    public function edit($id){
        return view('edittask', ['task' => Todo::findOrFail($id)]);
    }

    public function update(Request $request, $id){
        $todo = Todo::findOrFail($id);
        $input = $request['task'];
        $todo->update($input);

        return redirect()->route('myTasks');
    }

    //DeleteTask
    public function delete($id){
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route('myTasks');
    }
    
}
