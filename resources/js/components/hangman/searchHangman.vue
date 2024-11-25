<template>
    <div class="hangman-wrapper">
        <div class="wrapper">
            <div class="box-wrapper">
                <div class="box">
                    <img src="../assets/hangman/hangman-1.png">
                </div>
            </div>
            <div class="word">
                <span class="letter" v-for="(letter, i) in letters" :key="i">
                    {{  correctLetters.includes(letter) ? letter : '' }}
                </span>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        letters: {
            type: Array, // Ensure the type matches the expected data structure
            default: () => ['c', 'h', 'r', 'i', 's', 't', 'm', 'a', 's'] // Default value is an array of letters
        },
        correctLetters: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            amountOfWrongTries: 0,
        }
    },

    methods:{
        async checkLetter(event){
            const letter = event.key.toLowerCase();
            try {
                if (this.userInput === '') {
                    this.triggerShake();
                    return;

                }
                const response = await axios.post('/api/checkHangmanLetter', {
                    word: this.userInput,
                });

                const { result } = response.data;

                if (result) {
                    console.log('Word is correct!');
                    this.$bus.emit('correct');
                } else {
                    this.triggerShake();
                    console.log('Word is incorrect.');
                    this.generateRandomPlaceholder();
                }
            } catch (error) {
                console.error('Error sending data:', error);
                this.responseMessage = 'Error submitting the word.';
            }
            this.clearInput();
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
    position: absolute;
    top: 50;

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
        align-items: center;
        justify-content: center;
        margin: 0 3px;
        height: 50px;
        width: 20px;
        }
    }
}

// span{
//     display: inline-block;
//     width: 50px;
//     height: 10px;
//     background-color: #2980b9;
// }
</style>