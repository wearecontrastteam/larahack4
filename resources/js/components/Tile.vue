<template>
    <div class="tile-slot">
        <div class="shadow-tile" v-if="isFlippedDown" :id="id">
            <img :src="avatar_url" >
            <span class="name">{{name}}</span>
        </div>
        <div class="tile" :class="{ flipped: isFlippedDown }" :id="id">
            <img :src="avatar_url" >
            <span class="name">{{name}}</span>
        </div>
        <label class="btn flip-button" :class="{ flipped: isFlippedDown }">
            <input type="checkbox" @click="flipDownPerson">

            <i class="fa fa-undo" aria-hidden="true"></i>
        </label>
    </div>
</template>
<script>
    export default {
        props: ['id','avatar_url','name','bio','state'],
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
            flipDownPerson(){
                this.$emit('flipDownPerson', this.id);
            }
        }
    }
</script>
