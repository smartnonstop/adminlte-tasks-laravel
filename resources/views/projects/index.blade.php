@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                  <h2>My projects <a class="btn btn-primary float-sm-right" href="{{route('projects_create')}}">+ Add project</a></h2>

                  <br>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="60%">Name</th>
                        <th scope="col">Created ad</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $project)
                        <tr>
                          <td><a href="{{route('projects_show', $project->id)}}">{{$project->name}}</a></td>
                          <td>{{$project->created_at}}</td>
                          <td><a href="{{route('projects_edit', $project->id)}}">edit<a>
                            <form class="delete-form" action="{{route('projects_destroy', $project->id)}}" method="POST">
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

@endsection
