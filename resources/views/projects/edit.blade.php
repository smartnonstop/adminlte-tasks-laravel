@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                  <a href="{{route('projects')}}">< Go back</a>
                  <h2>Edit project</h2>
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
                  <form action="{{route('projects_update', $data->id)}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                      <label>Name of project</label>
                      <input name="name" type="text" value="{{$data->name}}" class="form-control" aria-describedby="emailHelp" placeholder="Enter a name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
