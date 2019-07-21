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

            <h3>Leaderboard</h3>
            <table class="table">
                <tr>
                    <th class="game-host">User</th>
                    <th class="created-at">Wins</th>
                    <th></th>
                </tr>
                @foreach($wins_by_name as $user_and_wins)
                    <tr>
                        <td>{{$user_and_wins[0]->name}}</td>
                        <td>{{$user_and_wins[1]}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-md-4">
            <recent-games></recent-games>
        </div>
    </div>
</div>
@endsection
