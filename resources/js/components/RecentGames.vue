<template>
    <div class="lobby">
        <h3>Recent Games</h3>
        <table class="table">
            <tr>
                <th>Game Host</th>
                <th>Challenger</th>
                <th>Winner</th>
                <th></th>
            </tr>
            <tr v-if="games.length === 0">
                <td colspan="3">There are no recently finished games, why not <a href="/game/create">create one</a>?</td>
            </tr>
            <tr v-for="game in games">
                <td>{{ game.player_one }}</td>
                <td>{{ game.player_two }}</td>
                <td>{{ game.winner }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "FindGames",
        data(){
            return {
                games: []
            };
        },
        mounted(){
            this.getGames();
            setInterval(this.getGames, 30000);
        },
        methods:{
            getGames(){
                axios.get('/api/v1/games/recent')
                    .then(response => {
                        this.games = response.data.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>