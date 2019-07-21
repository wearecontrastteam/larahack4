<template>
    <div class=" col-md-12 play">
        <opponent username="Test Name 1"></opponent>
        <tiles></tiles>
        <you></you>
    </div>
</template>

<script>
    export default {
        name: "Game",
        props: ['gameId'],
        data(){
            return {
                apiBase: '/api/v1/game/',
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
                        console.log(response);
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