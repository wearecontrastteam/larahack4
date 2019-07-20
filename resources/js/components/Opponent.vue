<template>
    <div class="opponent">
        <p><strong>Opponent Name:</strong> {{username}}</p>
    </div>
</template>


<script>
    export default {
        props: [
            'username'
        ],
    }
</script>
