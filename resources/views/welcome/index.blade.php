@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 splash-screen">
                <img src="/img/logo.svg"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Play Guess Who with contributors from the Laravel Github Repository</h2>
                <a class="btn btn-primary btn-lg mt-4" href="{{route('register')}}">Sign Up</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <img class="img-fluid" src="/img/play.png" alt="Play GitWho">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-muted text-center">
                <p>Created by Mike Gatward, Andy Knight & Simon Monk-Chipman for <a href="https://larahack.com">LaraHack #4</a></p>
                <p>Check out the code on <a href="https://github.com/wearecontrastteam/larahack4">GitHub</a></p>
            </div>
        </div>
    </div>
@endsection
