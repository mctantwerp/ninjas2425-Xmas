<template>
    <div class="hangman-wrapper">
        <div class="wrapper">
            <div class="box-wrapper">
                <div class="box">
                    <img :src="`./images/hangman/hangman-${amountOfWrongTries + 1}.png`" alt="Hangman">
                </div>
            </div>
            <div class="word">
                <span 
                    class="letter" 
                    :class="{ 'correct': correctLetters[i] && correctLetters[i] !== ' ' }"
                    v-for="(letter, i) in letters" 
                    :key="i">
                    {{ correctLetters[i] }}
                </span>
            </div>
        <div v-if="gameOver" class="popup-overlay">
            <div class="popup">
                <h2>Game Over</h2>
                <p>Would you like to try again?</p>
                <button @click="resetGame">Restart</button>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        
        letters: {
            type: Array,
            default: () => ['c', 'h', 'r', 'i', 's', 't', 'm', 'a', 's']
        }
        
    },
    data() {
        return {
            amountOfWrongTries: 0,
            correctLetters: [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            amountOfWrongTries: 0,
            gameOver: false
        }
    },

    methods:{
        async checkLetter(event){
            const letter = event.key.toLowerCase();
            //console.log(letter);
            try {
                const response = await axios.post('/api/checkHangmanLetter', {
                    letter: letter,
                });

                const { result } = response.data;
                //console.log(result)
                this.addLetterToArray(letter, result);
            } catch (error) {
                console.error('Error sending data:', error);
                this.responseMessage = 'Error submitting the word.';
            }
        },

        addLetterToArray(inputletter, response){
            if(response.length > 0 && this.amountOfWrongTries < 10){
                response.forEach((index) => {
                    this.correctLetters[index] = inputletter;
                    this.checkIfGameIsFinished();
                });
            }
            if(response.length == 0 && this.amountOfWrongTries < 10){
                this.amountOfWrongTries++;
                this.checkIfGameIsFinished();
            }

            if(this.amountOfWrongTries >= 10){
                console.log('Game Over');
                this.gameOver = true;
            }
        },

        resetGame() {
            this.amountOfWrongTries = 0;
            this.correctLetters = [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '];
            this.gameOver = false;
        },

        checkIfGameIsFinished(){            
            if (this.correctLetters.join('') === this.letters.join('')) {
                console.log('You have guessed the word!');
                this.$bus.emit('correct');
            }
        }
    },

    mounted(){
        console.log('mounted');
        window.addEventListener('keydown', this.checkLetter);
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.hangman-wrapper{
    position: relative;
    top: -200;

    .wrapper {
        display: flex;
        flex-direction: column;
        gap: 32px;
        width: 100%;

        .box-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: $color-wit;
            border-radius: 20px;
            text-align: center;
            box-shadow: 2px -4px 4px #00000042;


            .box {
                display: flex;
                flex-direction: column;
                gap: 16px;
                padding: 32px;
            }
        }

        .letter {
        border-bottom: 3px solid $color-wit;
        display: inline-flex;
        font-size: 30px;
        align-items: end;
        justify-content: center;
        margin: 0 3px;
        height: 50px;
        width: 20px;
            &.correct{
                border-bottom: none;
                color: $color-wit;
            }
        }
    }
}

.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;

    .popup {
        background: $color-wit;
        padding-right: 48px;
        padding-left: 48px;
        padding-top: 20px;
        padding-bottom: 20px;
        border-radius: 8px;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 24px;

        h2 {
            margin-bottom: 10px;
        }
    }
}
</style>