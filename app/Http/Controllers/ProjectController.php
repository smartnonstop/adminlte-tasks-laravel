<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $projects = Project::all();
      $projects = Project::where('user_id', Auth::user()->id)->get();

      return view('projects.index', ['data' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validated = $request->validate([
        'name' => 'required'
      ]);

      $project = new Project();
      $project->name = $request->name;
      $project->user_id = Auth::user()->id;
      $project->save();

      return redirect()->route('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        if(!$project || $project->user_id !== Auth::user()->id){
          return redirect()->route('projects');
        }

        return view('projects.show', ['data' => $project, 'status' => 'All tasks']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        if($project && $project->user_id !== Auth::user()->id) {
          return redirect()->route('projects');
        }

        return view('projects.edit', ['data' => $project]);
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
        $project = Project::find($id);
        if($project->user_id !== Auth::user()->id) {
          return redirect()->route('projects');
        }

        $project->name = $request->name;
        $project->save();
        return redirect()->route('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $project = Project::find($id);
      if($project->user_id !== Auth::user()->id) {
        return redirect()->route('projects');
      }

      $tasks = Task::where('project_id', $project->id)->get();
      foreach($tasks as $task) {
        $task->delete();
      }

      $project->delete();


      return redirect()->route('projects');
    }

    public function showWithTaskStatus($id, $status)
    {
        $project = Project::find($id);
        if(!$project || $project->user_id !== Auth::user()->id){
          return redirect()->route('projects');
        }

        $project->setStatus($status);

        return view('projects.show', ['data' => $project, 'status' => $status]);
    }
}
