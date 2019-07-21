<template>
    <div class=" col-md-12 play">
        <opponent :game="game"></opponent>
        <tiles :game="game"></tiles>
        <you :game="game"></you>
    </div>
</template>

<script>
    export default {
        name: "Game",
        props: ['gameId'],
        data(){
            return {
                apiBase: '/api/v1/game/',
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
                            this.game.people = JSON.parse(data.people);
                            this.game.person = data.person;
                            this.game.opponent = data.opponent;

                            if(this.state === null){
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
            }
        }
    }
</script>

<style scoped>

</style>