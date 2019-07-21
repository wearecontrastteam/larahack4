@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 splash-screen">
                <img src="/img/logo.svg"/>
                <p>Play Guess who with a Git repo</p>

                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif

            </div>

        </div>
    </div>
@endsection
