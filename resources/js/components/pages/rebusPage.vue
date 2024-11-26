<template>
    <div class="game-container">
        <transition name="fade-with-slide" mode="out-in">
            <first-popup v-if="!gameStarted" @game-start="startGame" :game="'rebus'">
                <template v-slot:content>
                    <h2>Rebus 🧩</h2>
                    <p>Can you figure out what message is encoded in these images? Find the secret two words! B5TKC</p>
                </template>
                <template v-slot:action>Continue</template>
            </first-popup>

            <search-rebus v-else-if="gameStarted && !correctAnswer"></search-rebus>

            <final-popup v-else>
                <template v-slot:content>
                    <h2>Congrats!</h2>
                    <p>The word in this game is "Happy". Good luck with the rest of the games!</p>
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
        }
    },
    beforeUnmount() {
        // Remove event listener when the component is destroyed
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
    justify-content: center;
    overflow: hidden;
    width: 100%;
}
</style>