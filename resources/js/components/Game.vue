<template>

    <div class="container">
        <div class=" col-md-12 play">
            <div class="row">
                <div class="col-md-3">
                    <you :game="game"></you>
                    <opponent :game="game"></opponent>
                    <question :game="game" :game_id="gameId"></question>
                </div>
                <div class="col-md-9">
                    <tiles :game="game" @stateupdated="saveGameState"></tiles>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Game",
        props: ['gameId'],
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
                    player: ''
                }
            };
        },
        mounted(){
            this.updateGameState();
        },
        computed: {

        },
        methods: {
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

                            if(this.game.state === null){
                                this.game.state = data.state;
                            }
                        }
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