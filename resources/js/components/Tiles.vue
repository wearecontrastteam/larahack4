<template>
    <div class="game-board">
        <template v-for="person in game.people">
            <tile :id="person.id" :avatar_url="person.avatar_url" :name="person.name" :bio="person.bio"></tile>
        </template>
    </div>
</template>


<script>
    export default {
        props: ['game'],
    }
</script>
