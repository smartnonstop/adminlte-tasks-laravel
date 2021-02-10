@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                  <a href="{{route('projects_show', $project_id)}}">< Go back</a>
                  <h2>Create new task</h2>
                  <br>
                  @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                      <ul>
                        @foreach($errors->all() as $err)
                          <li>{{$err}}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                  <form action="{{route('tasks_store', $project_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Name of task</label>
                      <input name="name" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter a name">
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-control" style="width:200px;">
                        @foreach(config('task_status.options') as $option)
                          <option value="{{$option}}">{{$option}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>File</label>
                      <input name="file" type="file" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
