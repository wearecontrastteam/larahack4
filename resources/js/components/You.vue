<template>
    <div class="you">

        {{game.person.avatar_url}}
        {{game.person.name}}
    </div>
</template>


<script>
    export default {
        props: ['game']
    }
</script>
