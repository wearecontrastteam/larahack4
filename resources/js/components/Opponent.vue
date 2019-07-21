<template>
    <div class="opponent" :class="[game.player, {'is-turn': (game.currentPlayer !== game.player_number) }]">
        <span class="player-title">
            Opponent
        </span>
        <p class="name">{{game.opponent}}</p>
    </div>
</template>

<script>
    export default {
        props: [
            'game'
        ],
    }
</script>
