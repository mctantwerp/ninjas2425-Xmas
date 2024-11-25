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
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        letters: {
            type: Array, // Ensure the type matches the expected data structure
            default: () => ['c', 'h', 'r', 'i', 's', 't', 'm', 'a', 's']
        },
        
    },
    data() {
        return {
            amountOfWrongTries: 0,
            correctLetters:
            {
                type: Array,
                default: () => [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ']
            },
            amountOfWrongTries: 0,
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
                console.log(this.correctLetters);

                
            } catch (error) {
                console.error('Error sending data:', error);
                this.responseMessage = 'Error submitting the word.';
            }
        },

        addLetterToArray(inputletter, response){
            if(response.length > 0){
                response.forEach((index) => {
                    this.correctLetters[index] = inputletter;
                });
            }
            if(response.length == 0){
                this.amountOfWrongTries++;
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

// span{
//     display: inline-block;
//     width: 50px;
//     height: 10px;
//     background-color: #2980b9;
// }
</style>