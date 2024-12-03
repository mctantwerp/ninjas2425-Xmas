<template>
    <div class="game-container">
        <a href="/rebus" class="box">
            <div class="top-left" :class="{ 'solved': rebusSolved }">
                <img src="./assets/nav-cup.png" alt="christmas coffee cup">
                <h2>Rebus</h2>
                <span v-if="rebusSolved">Happy</span>
                <span class="status-box solved" v-if="rebusSolved">Solved</span>
            </div>
        </a>
        <a href="/tree" class="box">
            <div class="top-right" :class="{ 'solved': treeSolved }">
                <img src="./assets/nav-tree.png" alt="christmas tree">
                <h2>Tree</h2>
                <span v-if="treeSolved">From</span>
                <span class="status-box solved" v-if="treeSolved">Solved</span>
            </div>
        </a>
        <a href="/hangman" class="box">
            <div class="bottom-left" :class="{ 'solved': hangmanSolved }">
                <img src="./assets/nav-ginger.png" alt="christmas gingerman">
                <h2>Hangman</h2>
                <span v-if="hangmanSolved">Christmas</span>
                <span class="status-box solved" v-if="hangmanSolved">Solved</span>
            </div>
        </a>
        <a href="/search" class="box">
            <div class="bottom-right" :class="{ 'solved': searchSolved }">
                <img src="./assets/nav-present.png" alt="christmas present">
                <h2>Search</h2>
                <span v-if="searchSolved">MCT</span>
                <span class="status-box solved" v-if="searchSolved">Solved</span>
            </div>
        </a>
    </div>
</template>

<script>
import Cookies from 'js-cookie';
export default {
    data() {
        return {
            rebusSolved: false,
            treeSolved: false,
            hangmanSolved: false,
            searchSolved: false,
        }
    },
    methods: {
    },
    beforeMount() {
        this.rebusSolved = Cookies.get('rebusSolved');
        this.treeSolved = Cookies.get('treeSolved');
        this.hangmanSolved = Cookies.get('hangmanSolved');
        this.searchSolved = Cookies.get('searchSolved');
    }
}
</script>

<style lang="scss" scoped>
@import "../../sass/_variables.scss";

.game-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 10px;
    margin-bottom: 128px;
    width: 100%;

    .box {
        position: relative;
        padding: 20px;
        text-align: center;
        font-weight: bold;
        border-radius: 8px;
        height: 130px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: $color-turquoise-20;

        img {
            width: 35px;
            height: 35px;
        }

        .status-box {
            border: 2.5px solid $illustrations-green;
            padding: 4px 8px;
            border-radius: 8px;
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
            position: absolute;
            top: 0px;
            right: 0px;
        }
    }

    .solved {
        opacity: 0.75;
    }
}

.top-left {}

.top-right {}

.bottom-left {}

.bottom-right {}

.top-left,
.top-right,
.bottom-left,
.bottom-right {}
</style>