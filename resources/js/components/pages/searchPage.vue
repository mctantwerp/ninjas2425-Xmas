<template>
    <div class="game-container">
        <transition name="fade-with-slide" mode="out-in">
            <first-popup v-if="!gameStarted" @game-start="startGame" :game="'search'">
                <template v-slot:content>
                    <h2>Christmas search 🕵️</h2>
                    <p>Find Santa's frozen present and reveal one of the words for the Christmas Challenge. BTF41</p>
                </template>
                <template v-slot:action>Continue</template>
            </first-popup>

            <search-game v-else-if="gameStarted && !correctAnswer"></search-game>

            <final-popup v-else>
                <template v-slot:content>
                    <h2 id="popup-title">Congrats!</h2>
                    <p>The word in this game is 'MCT'. Complete the other challenges to reveal the entire sentence. Good
                        luck!</p>
                </template>
                <template v-slot:action><button @click="redirectSubmitPage">Submit sentence</button></template>
            </final-popup>
        </transition>
    </div>
</template>


<script>
import confetti from "canvas-confetti";
export default {
    data() {
        return {
            gameStarted: false,
            isDesktop: window.innerWidth > 1024,
            correctAnswer: false,
        }
    },
    computed: {
        viewportWidth() {
            return window.innerWidth;
        }
    },
    watch: {
    },
    mounted() {
        window.addEventListener('resize', this.checkViewport);
        this.$bus.on('correct', () => {
            console.log('Correct word! Event listener works!');
            this.correctAnswer = true;
            this.triggerConfetti();
        });
    },
    methods: {
        triggerConfetti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 },
            });
        },
        startGame() {
            //reset height to start
            window.scrollTo(0, 0);
            //
            this.gameStarted = true;
            document.getElementsByClassName('snow')[0].style.display = "none";
            document.getElementsByClassName('gingerman')[0].style.display = "none";
            document.getElementsByClassName('candy')[0].style.display = "none";
            document.getElementsByClassName('footer')[0].style.display = "none";
        },
        checkViewport() {
            this.isLargeViewport = window.innerWidth > 1024;
            console.log(this.isLargeViewport);
        },
        redirectSubmitPage() {
            window.location.href = '/submit';
        },
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkViewport);
        this.$bus.off('correct');
    },
}
</script>

<style lang="scss" scoped>
.game-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: start;
    overflow: hidden;
    width: 100%;
}
</style>