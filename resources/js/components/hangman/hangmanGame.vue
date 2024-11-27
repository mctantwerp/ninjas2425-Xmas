<template>
    <div class="box-wrapper">
        <div class="box">
            <img :src="`./images/hangman/hangman-${amountOfWrongTries + 1}.png`" alt="Hangman">
        </div>
    </div>
    <div class="word">
        <span class="letter" :class="{ 'correct': correctLetters[i] && correctLetters[i] !== ' ' }"
            v-for="(letter, i) in letters" :key="i">
            {{ correctLetters[i] }}
        </span>
    </div>
    <div class="user-input">
        <div class="input" ref="shakeElement">
                <input type="text" placeholder="Enter a letter" v-model="userInput">
                <i class="fa-regular fa-trash-can" @click="clearInput"></i>
        </div>
        <button @click="checkLetter">
                <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
    <div v-if="gameOver" class="popup-overlay">
            <negative-window-popup @submitRetryReset="resetGame">
                <template v-slot:content>
                    <h2 class="error-text">Uh oh!</h2>
                    <p>You failed the challenge. No worries though, you can retry as many times as you want!</p>
                </template>
                <template v-slot:action>
                    Retry
                </template>
            </negative-window-popup>
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
            userInput: "",
            gameOver: false,
        }
    },
    methods: {
        async checkLetter(event){
            console.log(this.userInput);
            //console.log(letter);
            try {
                const response = await axios.post('/api/checkHangmanLetter', {
                    letter: this.userInput,
                });

                const { result } = response.data;
                //console.log(result)
                this.addLetterToArray(this.userInput, result);
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
            this.clearInput();

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
        },
        clearInput() {
            this.userInput = "";
        },
        checkIfGameIsFinished() {
            if (this.correctLetters.join('') === this.letters.join('')) {
                console.log('You have guessed the word!');
                this.$bus.emit('correct');
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

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

.word{
    display: flex;
    align-items: center;
    justify-content: center;
    .letter {
        border-bottom: 3px solid $color-wit;
        display: inline-flex;
        font-size: 30px;
        align-items: end;
        justify-content: center;
        margin: 0 3px;
        height: 50px;
        width: 20px;

        &.correct {
            border-bottom: none;
            color: $color-wit;
        }
    }
}

.user-input{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    button{ 
        width: 100px;
    }
}


</style>