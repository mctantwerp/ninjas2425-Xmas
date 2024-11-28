<template>
    <div class="hangman-wrapper">
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
        <div class="user-input-container">
            <div class="input" ref="shakeElement">
                <input type="text" placeholder="Enter a letter" v-model="userInput" maxlength="1" ref="inputLetter">
                <i class="fa-regular fa-trash-can" @click="clearInput"></i>
            </div>
            <button @mousedown.prevent="checkLetter" @touchdown.prevent="checkLetter">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
        <transition name="fade-with-slide" mode="out-in">
            <div v-if="gameOver" class="popup-overlay">
                <negative-window-popup @click="resetGame">
                    <template v-slot:content>
                        <h2 class="error-text">Uh oh!</h2>
                        <p>You failed the challenge. No worries though, you can retry as many times as you want!</p>
                    </template>
                    <template v-slot:action>
                        Retry
                    </template>
                </negative-window-popup>
            </div>
        </transition>
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
        async checkLetter(event) {
            console.log(this.userInput);
            try {
                const response = await axios.post('/api/checkHangmanLetter', {
                    letter: this.userInput,
                });

                const { result } = response.data;
                this.addLetterToArray(this.userInput, result);
            } catch (error) {
                console.error('Error sending data:', error);
                this.responseMessage = 'Error submitting the word.';
            }
        },

        addLetterToArray(inputletter, response) {
            if (response.length > 0 && this.amountOfWrongTries < 10) {
                response.forEach((index) => {
                    this.correctLetters[index] = inputletter;
                    this.checkIfGameIsFinished();
                });
            }
            if (response.length == 0 && this.amountOfWrongTries < 10) {
                this.amountOfWrongTries++;
                this.checkIfGameIsFinished();
            }

            if (this.amountOfWrongTries >= 10) {
                console.log('Game Over');
                this.gameOver = true;
                this.$refs.inputLetter.blur();
            }
            this.clearInput();

        },
        resetGame() {
            this.amountOfWrongTries = 0;
            this.correctLetters = [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '];
            this.gameOver = false;
        },

        checkIfGameIsFinished() {
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

.hangman-wrapper {
    width: 100%;

    .box-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: $color-wit;
        border-radius: 20px;
        text-align: center;
        box-shadow: 2px -4px 4px #00000042;
        width: 100%;


        .box {
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding: 32px;
        }
    }

    .word {
        display: flex;
        align-items: center;
        justify-content: space-around;

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

    .user-input-container {
        display: flex;
        flex-direction: row;
        gap: 16px;
        margin-top: 16px;

        .input {
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;


            input {
                margin: 0px;
                height: 60px;
                width: 100%;
            }

            i {
                color: $color-rood-40;
                font-size: 16px;
                position: absolute;
                right: 16px;
            }
        }

        button {
            width: 40%;
            max-width: 150px;
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
    backdrop-filter: blur(2px);
}
</style>