<template>
    <div class="you">

        <div class="your-selection">
            <img :src="avatar_url" >
            <span class="name">{{name}}</span>
            <span v-if="this.bio.length != 0" class="bio">{{bio}}</span>
        </div>
    </div>
</template>


<script>
    export default {
        props: [
            'avatar_url',
            'name',
            'bio'
        ],
    }
</script>
