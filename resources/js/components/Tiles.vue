<template>
    <div class="game-board" :class="game.player">
        <template v-for="person in game.people">
            <tile :id="person.id"
                  :avatar_url="person.avatar_url"
                  :name="person.name"
                  :bio="person.bio"
                  :state="getPersonState(person.id)"
                  @flipDownPerson="flipDownPerson"
                  @flipUpPerson="flipUpPerson"
            ></tile>
        </template>
    </div>
</template>


<script>
    export default {
        props: ['game'],
        methods:{
            getPersonState(id){
                return this.game.state.find(e => e.id === id).state;
            },
            flipDownPerson(id){
                this.game.state.find(e => e.id === id).state = 0;

                this.$emit('stateupdated');
            },
            flipUpPerson(id){
                this.game.state.find(e => e.id === id).state = 1;
                this.$emit('stateupdated');
            }
        }
    }
</script>
