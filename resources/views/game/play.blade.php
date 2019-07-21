@extends('layouts.app')

@section('content')
    <game game-id="{{$game_id}}"></game>
@endsection

@section('scripts')
    <script>
        var pusher = new Pusher('{{config('services.pusher.app_key')}}', {
            cluster: 'eu'
        });
        var channel = pusher.subscribe('game-{{$game_id_hashed}}');
        channel.bind('game-updated', function(data) {
            console.log('A game-updated event was triggered with message: ' + data.message);
        });
        channel.bind('player-1-asks', function(data) {
            console.log('A player-1-asks event was triggered with message: ' + data.message);
        });
        channel.bind('player-1-answers', function(data) {
            console.log('A player-1-answers event was triggered with message: ' + data.message);
        });
        channel.bind('player-2-asks', function(data) {
            console.log('A player-2-asks event was triggered with message: ' + data.message);
        });
        channel.bind('player-2-answers', function(data) {
            console.log('A player-2-answers event was triggered with message: ' + data.message);
        });

        // Ask

        function ask(question) {
            //console.log(question);
            axios.post('/api/v1/game/{{$game_id}}/ask', {
                'question': question
            })


        }

        function answer(question) {
            //console.log(question);
            axios.post('/api/v1/game/{{$game_id}}/answer', {
                'question': question
            })
        }
    </script>
@endsection