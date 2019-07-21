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
        channel.bind('question', function(data) {
            console.log('A question event was triggered with message: ' + data.message);
        });

        // Ask

        function ask(question) {
            console.log(question);
            axios.post('/api/v1/game/{{$game_id}}/ask', {
                'game_id_hashed': '{{$game_id_hashed}}',
                'question': question
            })
        }
    </script>
@endsection