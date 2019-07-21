<template>
    <div class="question form-group">
        <input class="form-control" type="text" v-model="question" placeholder="Your Question" />
        <button class="btn btn-primary btn-block mt-1" @click="askQuestion()">Ask</button>
        <button class="btn btn-primary btn-block mt-1" @click="answerQuestion('yes')">Yes</button>
        <button class="btn btn-primary btn-block mt-1" @click="answerQuestion('no')">No</button>
        <button class="btn btn-primary btn-block mt-1" @click="endTurn()">End Turn</button>

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
            askQuestion: function () {
                console.log(this.question);
                axios.post('/api/v1/game/' + this.game_id + '/ask', {
                    'question': this.question
                });
            },
            answerQuestion(answer){
                axios.post('/api/v1/game/' + this.game_id + '/answer', {
                    'answer': answer
                });
            },
            endTurn(){
                axios.post('/api/v1/game/' + this.game_id + '/endturn');
            }
        },
    }
</script>
