@extends('layouts.app')

@section('content')
    <game game-id="{{$game_id}}" game-id-hashed="{{$game_id_hashed}}"></game>
@endsection

@section('scripts')
    <script>


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