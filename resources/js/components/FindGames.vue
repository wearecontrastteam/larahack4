<template>
    <div class="lobby">
        <h3>Find Games</h3>
        <table class="table">
            <tr>
                <th class="game-host">Game Host</th>
                <th class="created-at">Created At</th>
                <th></th>
            </tr>
            <tr v-if="games.length === 0">
                <td colspan="3">There are no games available to join, why not <a href="/game/create">create one</a>?</td>
            </tr>
            <tr v-for="game in games">
                <td>{{ game.player_one }}</td>
                <td>{{ game.created }}</td>
                <td>
                    <a class="btn btn-primary" :href="game.join_url">
                        Play
                    </a>
                </td>
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
                axios.get('/api/v1/games/matching')
                    .then(response => {
                        this.games = response.data.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>