<template>
    <div class="tile-slot">
        <div class="shadow-tile" v-if="flipped" :id="id">
            <img :src="avatar_url" >
            <span class="name">{{name}}</span>
            <span v-if="this.bio.length != 0" class="bio">{{bio}}</span>
        </div>
        <div class="tile" :class="{ flipped: flipped}" :id="id">
            <img :src="avatar_url" >
            <span class="name">{{name}}</span>
            <span v-if="this.bio.length != 0" class="bio">{{bio}}</span>
        </div>
        <label class="btn flip-button" :class="{ hide: flipped}">
            <input type="checkbox" v-model="flipped">

            <i class="fa fa-undo" aria-hidden="true"></i>
        </label>
    </div>
</template>
<script>
    export default {
        props: ['id','avatar_url','name','bio',],
        data() {
            return {
                flipped: false,
            }
        }
    }
</script>
