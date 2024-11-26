<template>
    <div class="wrapper">
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
        <div class="input">
            <input type="text" placeholder="Type in a letter here.">
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

    methods: {
        async checkLetter(event) {
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
            }
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
        }
    },

    mounted() {
        console.log('mounted');
        window.addEventListener('keydown', this.checkLetter);
        this.$bus.on('submitRetryReset', () => {
            this.resetGame();
        });
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

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

        &.correct {
            border-bottom: none;
            color: $color-wit;
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
}
</style>