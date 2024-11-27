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
    <input type="text">
</template>

<script>
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
</style>