<template>
    <div class="tile-slot">
        <div class="shadow-tile" v-if="isFlippedDown" :id="id">
            <img :src="avatar_url" >
            <span class="name">{{name}}</span>
        </div>
        <div class="tile" :class="{ flipped: isFlippedDown }" :id="id">
            <img :src="avatar_url" >
            <span class="name">{{name}}</span>
            <button class="btn btn-primary btn-block mt-1" @click="guessPerson()">Guess</button>
        </div>
        <div @click="togglePerson" class="btn flip-button" :class="{ flipped: isFlippedDown }">
            <i class="fa fa-undo" aria-hidden="true"></i>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['id','avatar_url','name','bio','state', 'gameId'],
        data() {
            return {
                flipped: false,
            }
        },
        computed:{
            isFlippedDown(){
                return this.state === 0;
            }
        },
        methods:{
            togglePerson(){
                if(this.isFlippedDown){
                    this.$emit('flipUpPerson', this.id);
                } else {
                    this.$emit('flipDownPerson', this.id);
                }
            },
            guessPerson: function () {
                console.log("Guess: " + this.id);
                axios.post('/api/v1/game/' + this.gameId + '/guess', {
                    'person_id': this.id
                }).then(response => {
                    //console.log(response);
                    if(response.data.status === 'ok') {
                        if(response.data.data.result === false) {
                            this.$emit('flipDownPerson', this.id);
                            axios.post('/api/v1/game/' + this.gameId + '/endturn');
                        }
                    }
                });
            },
        }
    }
</script>
