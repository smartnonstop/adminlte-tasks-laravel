@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                  <a href="{{route('projects')}}">< Go back</a>
                  <h2>{{$data->name}}</h2><br>
                  <h4>Tasks list: <a class="btn btn-primary float-sm-right" href="{{route('tasks_create', $data->id)}}">+ Add task</a></h4>
                  <p>Filter by status: &nbsp;
                      @foreach(config('task_status.options') as $option)
                        <a href="{{route('project_tasks_status', [$data->id, $option])}}"
                          @if($option===$status) {{"class=bold"}} @endif>{{$option}}</a>&nbsp;
                      @endforeach
                  </p>
                  <br>
                  <div class="tasks-table-wrapper">

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Status</th>
                          <th scope="col">Created ad</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data->tasks as $task)
                          <tr>
                            <td><a href="{{route('tasks_update', $task->id)}}">{{$task->name}}</a></td>
                            <td>{{$task->status}}</td>
                            <td>{{$task->created_at}}</td>
                            <td><a href="{{route('tasks_edit', $task->id)}}">edit</a>
                              <form class="delete-form" action="{{route('tasks_destroy', $task->id)}}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn-delete">delete</button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
