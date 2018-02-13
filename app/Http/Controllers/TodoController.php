<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index(){
    	$tasks = Todo::paginate(3);
    	return view('todo.index',compact('tasks'));
    }

    public function create(){
    	return view('todo.add');
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required | min:10 | max:20',
        ]);
        $task = Todo::create($request->all());
        $tasks = Todo::all();
        return view('todo.index',compact('tasks'));
    }
    public function edit($id){
        $task = Todo::findOrFail($id);
        return view('todo.edit', compact('task'));
    }
    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required | min:10 | max:20',
        ]);
        $task = Todo::findOrFail($request->id);
        $task->name = $request->name;
        $task->save();
        $tasks = Todo::all();
        return view('todo.index',compact('tasks'));
    }
    public function destroy($id){
         $task = Todo::findOrFail($id);
         $task->delete();
         $tasks = Todo::all();
         return view('todo.index',compact('tasks'));
    }
    public function search(Request $request){
       $task = Todo::where('name','LIKE',"%$request->term%")->pluck('name');
       if( empty($task->all())){
        return ['No Task Found...'];
       }else{
        return $task;
       }
    }
}
