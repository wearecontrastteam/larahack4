<template>

    <div class="container">
        <div class=" col-md-12 play">
            <div class="row">
                <div class="col-md-3 players">
                    <opponent :game="game"></opponent>
                    <you :game="game"></you>
                    <question :game="game" :game_id="gameId" :channel="channel"></question>
                    <template v-if="game.status == 4")>
                        <h3 v-if="game.winner == game.player_number">You win!</h3>
                        <h3 v-if="game.winner != game.player_number">You lose!</h3>
                    </template>
                    Subturn: {{game.subturn}}<br>
                </div>
                <div class="col-md-9">
                    <tiles :game-id="gameId" :game="game" @stateupdated="saveGameState"></tiles>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Game",
        props: ['gameId', 'gameIdHashed'],
        data(){
            return {
                game: {
                    opponent: '',
                    currentPlayer: null,
                    people: [],
                    person: {
                        id: '',
                        avatar_url: '',
                        name: '',
                        bio: ''
                    },
                    state: null,
                    player: '',
                    player_number: '',
                    status: null,
                    subturn: null,
                    winner: null,
                },
                pusher: null,
                channel: null
            };
        },
        mounted(){
            this.updateGameState();

            this.initPusher();
        },
        computed: {
            getPusherChannelName(){
                return 'game-' + this.gameIdHashed;
            }
        },
        methods: {
            initPusher(){
                this.pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
                    cluster: process.env.MIX_PUSHER_APP_CLUSTER
                });

                this.channel = this.pusher.subscribe(this.getPusherChannelName);
                this.channel.bind('game-updated', function(data) {
                    this.updateGameState();
                }.bind(this));
            },
            updateGameState(){
                axios.get(this.getApiUrl())
                    .then(response => {
                        if(response.data.status === 'ok'){
                            let data = response.data.data;
                            this.game.currentPlayer = data.current_player;
                            this.game.people = data.people;
                            this.game.person = data.person;
                            this.game.opponent = data.opponent;
                            this.game.player = data.player;
                            this.game.player_number = data.player_number;
                            this.game.turn = data.turn;
                            this.game.subturn = data.subturn;
                            this.game.status = data.status;
                            this.game.winner = data.winner;

                            if(this.game.state === null){
                                this.game.state = data.state;
                            }
                        }

                        console.log(this.game);
                    });
            },
            getApiUrl(url){
                let apiUrl = '/api/v1/game/'+this.gameId+'/';
                if(url !== undefined){
                    apiUrl += url;
                }

                return apiUrl;
            },
            saveGameState(){
                axios.post(this.getApiUrl(), this.getFormattedGameStateToSave())
                    .then(response => {
                        console.log(response);
                    })
            },
            getFormattedGameStateToSave() {
                return {
                    state: this.game.state
                };
            }
        }
    }
</script>

<style scoped>

</style>