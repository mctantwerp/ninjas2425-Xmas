<template>
    <div class="game-container">
        <transition name="fade">
            <first-popup v-if="!gameStarted" class="absolute-center" @game-start="startGame" :game="'rebus'">
                <template v-slot:content>
                    <h2>Rebus</h2>
                    <p>Can you figure out what message is encoded in these images? Find the secret two words!</p>
                </template>
                <template v-slot:action>Continue</template>
            </first-popup>
        </transition>

        <transition name="fade">
            <search-rebus v-if="gameStarted && !correctAnswer" class="absolute-center">
            </search-rebus>
        </transition>

        <transition name="fade">
            <final-popup v-if="correctAnswer" class="absolute-center">
                <template v-slot:content>
                    <h2>Congrats!</h2>
                    <p>The words in this game are "NXT Media". Good luck with the rest of the game!</p>
                </template>
                <template v-slot:action>Submit sentence</template>
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
        }
    },
    beforeUnmount() {
        // Remove event listener when the component is destroyed
        window.removeEventListener('resize', this.checkViewport);
        this.$bus.off('correct');
    },
}
</script>

<style>
.game-container {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* .absolute-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    max-width: 600px;
    text-align: center;
} */

/* Fade Transition */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>