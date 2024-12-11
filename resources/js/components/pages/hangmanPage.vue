<template>
    <div class="game-container">
        <transition name="fade-with-slide" mode="out-in" @before-enter="resetScrollPosition">
            <first-popup v-if="!gameStarted" @game-start="startGame" :game="'hangman'">
                <template v-slot:content>
                    <h2>Hangman 🧍</h2>
                    <p>Type a letter and see if it occurs anywhere in the word. With this word you can continue your
                        search!</p>
                </template>
                <template v-slot:action>Continue</template>
            </first-popup>

            <hangman-game v-else-if="gameStarted && !hangmanSolved"></hangman-game>

            <final-popup v-else>
                <template v-slot:content>
                    <h2>Congrats!</h2>
                    <p>The word in this game is "christmas". Good luck with the rest of the games!</p>
                </template>
                <template v-slot:action><button @click="redirectHomePage">Go Home<i
                            class="fa-regular fa-house-blank"></i></button></template>
            </final-popup>
        </transition>
    </div>
</template>

<script>
import Cookies from 'js-cookie';
import confetti from "canvas-confetti";
export default {
    data() {
        return {
            gameStarted: false,
            isDesktop: window.innerWidth > 1024,
            hangmanSolved: false,
        }
    },
    computed: {
        viewportWidth() {
            return window.innerWidth;
        }
    },
    mounted() {
        //event listener for window resize
        window.addEventListener('resize', this.checkViewport);
        //game correct event listener
        this.$bus.on('correct', () => {
            //console.log('Correct word! Event listener works!');
            this.hangmanSolved = true;

            // console.log(this.hangmanSolved);
            // console.log(this.gameStarted);
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
            this.hangmanSolved = false;
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
            //console.log(this.isLargeViewport);
        },
        redirectHomePage() {
            window.location.href = '/';
        },
        resetScrollPosition() {
            window.scrollTo(0, 0, 'smooth');
        }
    },
    beforeMount() {
        //check if hangman has already been completed
        const cookieValue = Cookies.get('hangmanSolved');
        if (cookieValue === "1") {
            this.hangmanSolved = true;
            this.gameStarted = true;
        }
    },
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
