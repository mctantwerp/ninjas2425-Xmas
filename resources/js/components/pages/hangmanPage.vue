<template>
    <div class="game-container">
        <transition name="fade-with-slide" mode="out-in" @before-enter="resetScrollPosition">
            <first-popup v-if="!gameStarted" @game-start="startGame" :game="'hangman'">
                <template v-slot:content>
                    <h2>Hangman 🧍</h2>
                    <p>Type a letter and see if it occurs anywhere in the word. With this word you can continue your
                        search! 18M12</p>
                </template>
                <template v-slot:action>Continue</template>
            </first-popup>

            <hangman-game v-else-if="gameStarted && !hangmanSolved"></hangman-game>

            <final-popup v-else>
                <template v-slot:content>
                    <h2>Congrats!</h2>
                    <p>The word in this game is "CHRISTMAS". Good luck with the rest of the games!</p>
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
            hangmanSolved: false,
        }
    },
    mounted() {
        window.addEventListener('resize', this.checkViewport);
        this.$bus.on('correct', () => {
            console.log('Correct word! Event listener works!');
            this.hangmanSolved = true;
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
        redirectSubmitPage() {
            window.location.href = '/submit';
        },
        checkViewport() {
            this.isLargeViewport = window.innerWidth > 1024;
            console.log(this.isLargeViewport);
        },
        redirectSubmitPage() {
            window.location.href = '/submit';
        },
        resetScrollPosition() {
            window.scrollTo(0, 0, 'smooth');
        }
    }
}
</script>

<style scoped>
.game-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    width: 100%;
}
</style>