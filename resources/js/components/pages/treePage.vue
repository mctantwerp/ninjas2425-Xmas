<template>
    <div class="game-container">
        <transition name="fade-with-slide" mode="out-in">
            <first-popup v-if="!gameStarted" @game-start="startGame" :game="'tree'">
                <template v-slot:content>
                    <h2>What is Karel's favourite color? 🎨</h2>
                    <p>Press the christmas ornament matching with that color and reveal the letters to assemble a word.
                        WOZG3
                    </p>
                </template>
                <template v-slot:action>Continue</template>
            </first-popup>

            <tree-game v-else-if="gameStarted && !correctAnswer"></tree-game>

            <final-popup v-else>
                <template v-slot:content>
                    <h2>Congrats!</h2>
                    <p>The word in this game is 'FROM'. Good luck with the rest of the challenges!</p>
                </template>
                <template v-slot:action><button @click="redirectSubmitPage">Submit sentence</button></template>
            </final-popup>
        </transition>
    </div>
</template>


<script>
import confetti from "canvas-confetti";
import Cookies from 'js-cookie';
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
        //event listener for window resize
        window.addEventListener('resize', this.checkViewport);
        //game correct event listener
        this.$bus.on('correct', () => {
            console.log('Correct word! Event listener works!');
            this.correctAnswer = true;
            this.triggerConfetti();
        });

        //check if tree game has already been completed
        const cookieValue = Cookies.get('tree');
        console.log(cookieValue);
        if (cookieValue === "1") {
            this.gameStarted = true;
            this.correctAnswer = true;
        }
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
        //remove event listener when the component is destroyed
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