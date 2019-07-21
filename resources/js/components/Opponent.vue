<template>
    <div class="opponent">
        <p><strong>Opponent Name:</strong> {{game.opponent}}</p>
    </div>
</template>


<script>
    export default {
        props: [
            'game'
        ],
    }
</script>
