<template>
    <div class="question form-group">
        <div class="asking" v-if="(game.currentPlayer === game.player_number) && (game.subturn===1)" >
            <input class="form-control" type="text" v-model="question.query" placeholder="Your Question" />
            <button class="btn btn-primary btn-block mt-1" @click="askQuestion()">Ask</button>
        </div>
        <div class="chat" v-if="(game.subturn > 1)">
                <span class="question" :class="[question.asker, {'asking': (question.asker == game.player) }]">
                    {{question.query}}
                </span>
                <span v-if="answer !== ''" class="answer" :class="[question.asker, {'asking': (question.asker !== game.player) }]">
                    {{answer}}
                </span>
        </div>
        <div class="answering" v-if="(game.currentPlayer !== game.player_number) && (game.subturn===2)" >
            <button class="btn btn-primary btn-block mt-1" @click="answerQuestion('yes')">Yes</button>
            <button class="btn btn-primary btn-block mt-1" @click="answerQuestion('no')">No</button>
        </div>
        <button v-if="(game.currentPlayer === game.player_number) && (game.subturn===3)" class="btn btn-primary btn-block mt-1" @click="endTurn()">End Turn</button>
        <p class="turn-message" v-if="game.currentPlayer !== game.player_number && game.subturn!==2" >
            Opponent's Turn
        </p>
    </div>
</template>

<script>

    export default {
        props: [
            'game',
            'game_id',
            'channel'
        ],
        data() {
            return {
                question: {
                    asker: '',
                    query: ''
                },
                answer: '',
                pusherSetup: false,
            }
        },
        mounted(){
            console.log(this.channel);

        },
        methods: {
            askQuestion: function () {
                console.log(this.question.query);
                axios.post('/api/v1/game/' + this.game_id + '/ask', {
                    'question': this.question.query
                });
            },
            answerQuestion(answer){
                axios.post('/api/v1/game/' + this.game_id + '/answer', {
                    'answer': answer
                });
            },
            endTurn(){
                axios.post('/api/v1/game/' + this.game_id + '/endturn');
            },
            setupPusher(){
                this.channel.bind('player-1-asks', function(data) {
                    this.$set(this, 'answer', '');
                    this.$set(this.question, 'asker', 'player-1');
                    this.$set(this.question, 'query', data.message);
                }.bind(this));
                this.channel.bind('player-1-answers', function(data) {
                    this.$set(this, 'answer', data.message);
                }.bind(this));
                this.channel.bind('player-2-asks', function(data) {
                    this.$set(this, 'answer', '');
                    this.$set(this.question, 'asker', 'player-2');
                    this.$set(this.question, 'query', data.message);
                }.bind(this));
                this.channel.bind('player-2-answers', function(data) {
                    this.$set(this, 'answer', data.message);
                }.bind(this));
                this.pusherSetup = true;
            }
        },
        watch: {
            channel(value){
                if(value !== null && this.pusherSetup === false){
                    this.setupPusher();
                }
            },
            "game.subturn": function (val) {
                if ( val === 1 )  {
                    this.$set(this.question, 'query', '');
                }
            }
        }
    }

</script>
