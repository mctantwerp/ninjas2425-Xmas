<template>
    <div class="game-container">
        <a href="/rebus" class="box">
            <div class="top-left">
                <img src="./assets/nav-cup.png" alt="christmas coffee cup">
                <h2>Rebus</h2>
            </div>
        </a>
        <a href="/tree" class="box">
            <div class="top-right">
                <img src="./assets/nav-tree.png" alt="christmas tree">
                <h2>Tree</h2>
            </div>
        </a>
        <a href="/hangman" class="box">
            <div class="bottom-left">
                <img src="./assets/nav-ginger.png" alt="christmas gingerman">
                <h2>Hangman</h2>
            </div>
        </a>
        <a href="/search" class="box">
            <div class="bottom-right">
                <img src="./assets/nav-present.png" alt="christmas present">
                <h2>Search</h2>
            </div>
        </a>
    </div>
</template>

<script>

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
        padding: 20px;
        text-align: center;
        font-size: 1.2rem;
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