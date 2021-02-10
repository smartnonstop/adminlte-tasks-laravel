@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                  <a href="{{route('projects_show', $data->project_id)}}">< Go back</a>
                  <h2>{{$data->name}}   <a class="float-sm-right" href="{{route('tasks_edit', $data->id)}}" style="font-size:14px;">Edit task</a></h2>
                  <p>Status: {{$data->status}}</p>
                  @if(strlen($data->file)>0)
                    <p>File: <a href="{{route('download', $data->file)}}">Download</a></p>
                  @endif



                </div>
            </div>
        </div>
    </div>
</div>

@endsection
