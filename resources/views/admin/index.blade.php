@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('admin.add_person')}}" method="POST">
            <div class="row">
                <div class="col-sm-6 offset-sm-2">
                    {{csrf_field()}}
                    <input type="text" class="form-control" name="github_username">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary form-control">Add</button>
                </div>
            </div>
        </form>

        <br>

        <div class="row">
            <div class="col-sm-2"><h3>GH&nbsp;ID</h3></div>
            <div class="col-sm-1"><h3>Login</h3></div>
            <div class="col-sm-2"><h3>Name</h3></div>
            <div class="col-sm-2"><h3>Avatar</h3></div>
            <div class="col-sm-4"><h3>Bio</h3></div>
        </div>
    @foreach($people as $person)
        <div class="row">
            <div class="col-sm-2">{{$person->github_id}}</div>
            <div class="col-sm-1">{{$person->login}}</div>
            <div class="col-sm-2">{{$person->name}}</div>
            <div class="col-sm-2"><img src="{{$person->avatar_url}}" width="75"></div>
            <div class="col-sm-4">{{$person->bio}}</div>
        </div>
    @endforeach
    </div>
@endsection