<template>
    <div class="game-board" :class="player_number">
        <template v-for="user in users">
            <tile :id="user.id" :avatar_url="user.avatar_url" :name="user.name" :bio="user.bio"></tile>
        </template>
    </div>
</template>


<script>
    export default {
        props: [
            'player_number',
        ],
        data() {
            return {
                users: [
                    {
                        id: '463230',
                        avatar_url: "https://avatars3.githubusercontent.com/u/463230?v=4",
                        name: "Taylor Otwell",
                        bio: "Creator of @laravel.",
                    },
                    {
                        id: '1234',
                        avatar_url: "https://avatars0.githubusercontent.com/u/1278785?s=460&v=4",
                        name: "mikeaag",
                        bio: "",
                    },

                ]
            }
        }
    }
</script>
