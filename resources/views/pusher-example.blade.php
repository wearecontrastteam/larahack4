@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        hello
    </div>
@endsection

@section('scripts')
    <script>
        var pusher = new Pusher('2b4eb8de38e8590e8e56', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');

        channel.bind('game-updated', function(data) {
            console.log('A game-updated event was triggered with message: ' + data.message);
        });

        channel.bind('chat-message', function(data) {
            console.log('A chat-message event was triggered with message: ' + data.message);
        });
    </script>
@endsection