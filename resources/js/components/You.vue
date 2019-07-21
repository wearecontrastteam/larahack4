<template>
    <div class="you mb-4" :class="game.player">
        <div class="your-selection">
            <img :src="game.person.avatar_url" >
            <span class="name">{{game.person.name}}</span>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['game'],
        computed: {
            hasBio(){
                return this.game.person.bio && this.game.person.bio.length > 0;
            }
        }
    }
</script>
