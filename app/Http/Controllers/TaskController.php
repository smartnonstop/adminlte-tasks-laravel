<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        // var_dump(config('task_status.options'));
        return view('tasks.create',['project_id' => $project_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($project_id, Request $request)
    {
       if(!$this->storeValidation($project_id, $request)) {
         return redirect()->route('projects');
       }

       $task = new Task();
       $task->project_id = $project_id;
       $task->name = $request->name;
       $task->status = $request->status;
       $task->file = "";
       if($request->file('file')) {
         $task->file = $request->file('file')->store('docs');
       }
       $task->save();

       return redirect()->route('projects_show', $project_id);

    }



    public function storeValidation($project_id, Request $request) {
      $validated = $request->validate([
        'name' => 'required'
      ]);

      $project = Project::find($project_id);
      if($project->user_id !== Auth::user()->id) {
        return false;
      }

      return true;
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
      if($task && $task->project && $task->project->user_id !== Auth::user()->id) {
        return redirect()->route('projects');
      }

      return view('tasks.show', ['data' => $task]);
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
      if($task && $task->project && $task->project->user_id !== Auth::user()->id) {
        return redirect()->route('projects');
      }

      // var_dump($task);
      return view('tasks.edit', ['data' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
      $task = Task::find($id);
      if($task && $task->project && $task->project->user_id !== Auth::user()->id) {
        return redirect()->route('projects');
      }

      $task->name = $request->name;
      $task->status = $request->status;
      if($request->file('file')) {
        $task->file = $request->file('file')->store('docs');
      }
      $task->save();

      return redirect()->route('projects_show', $task->project_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $task = Task::find($id);
      if($task && $task->project && $task->project->user_id !== Auth::user()->id) {
        return redirect()->route('projects');
      }

      $project_id = $task->project_id;

      $task->delete();

      return redirect()->route('projects_show', $project_id);
    }

}
