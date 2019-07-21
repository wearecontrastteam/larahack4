<template>
    <div class="question form-group">
        <input class="form-control" type="text" v-model="question" placeholder="Your Question" />
        <button class="btn btn-primary btn-block mt-1" @click="askQuestion(question)">Ask</button>
    </div>
</template>

<script>
    export default {
        props: [
            'game',
            'game_id'
        ],
        data() {
            return {
                question: "",
            }
        },
        methods: {
            askQuestion: function (question) {
                console.log(question);
                axios.post('/api/v1/game/' + this.game_id + '/ask', {
                    'question': question
                })
            },
        },
    }
</script>
