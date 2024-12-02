<template>
    <div class="game-container">
        <a href="/rebus">
            <div class="box top-left">
                <img src="./assets/nav-cup.png" alt="">
                <h2>Rebus</h2>
            </div>
        </a>
        <a href="/tree">
            <div class="box top-right">
                <img src="./assets/nav-tree.png" alt="">
                <h2>Tree</h2>
            </div>
        </a>
        <a href="/hangman">
            <div class="box bottom-left">
                <img src="./assets/nav-ginger.png" alt="">
                <h2>Hangman</h2>
            </div>
        </a>
        <a href="/search">
            <div class="box bottom-right">
                <img src="./assets/nav-present.png" alt="">
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
}

.box {
    padding: 20px;
    border: 1px solid #000;
    text-align: center;
    font-size: 1.2rem;
    font-weight: bold;
    border-radius: 8px;
    height: 130px;
    width: 150px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: center;
    justify-content: center;
    text-align: center;

    img {
        width: 35px;
        height: 35px;
    }
}

.top-left {}

.top-right {}

.bottom-left {}

.bottom-right {}

.top-left,
.top-right,
.bottom-left,
.bottom-right {
    background-color: $color-turquoise-20;
}
</style>