@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <a class="btn btn-primary" href="/game/create"> Create New Game</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <find-games></find-games>
        </div>
        <div class="col-md-4">
            <recent-games></recent-games>
        </div>
    </div>
</div>
@endsection
