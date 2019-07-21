@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <a class="btn btn-primary" href="/game/create"> Create New Game</a>
        </div>
        <div class="col-md-4">
            <div class="lobby">
                <h3>Find Games</h3>
                <table class="table">
                    <tr>
                        <th class="game-host">
                            Game Host
                        </th>
                        <th class="created-at">
                            Created At
                        </th>
                        <th>
                    </tr>
                    <tr>
                        <td>
                            Mikeaag
                        </td>
                        <td>
                            {{date("H:i:s d-m-Y")}}
                        </td>
                        <td>
                            <a class="btn btn-primary" href="#">
                                Join
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
