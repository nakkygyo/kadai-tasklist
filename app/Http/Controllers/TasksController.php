<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\User;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = \Auth::user()->tasks();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function store(Request $request)
    {
        $id=\Auth::id();
        
        $this->validate($request, [
            'content'=> 'required|max:255',
            "status"=>"required|max:10",
            ]);
        
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->user_id=$id;
        $task->save();
        
        return redirect()->route("users.show", ["id"=>$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (\Auth::id() === $task->user_id) {
        return view('tasks.show', [
            'task' => $task,
        ]);
        }
        
        else {
            return redirect("/");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        
        if (\Auth::id() === $task->user_id) {
            return view("tasks.edit", ["task"=>$task]);
        }
        
        else {
                return redirect("/");
        }
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $user_id=\Auth::id();
        
        $this->validate($request, [
            'content'=> 'required|max:255',
            "status"=> "required|max:10",
            ]);
        
        $task = Task::find($id);
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        
        return redirect()->route("users.show", ["id"=>$user_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id=\Auth::id();
        
        $task = Task::find($id);
        
        if (\Auth::id() === $task->user_id) {
            $task->delete();
            return redirect()->route("users.show", ["id"=>$user_id]);
        }
        
        else {
            return redirect("/");
        }
    }
}
