<template>
    <div class="game-container">
        <transition name="fade">
            <first-popup v-if="!gameStarted && !codeCorrect" class="absolute-center" @code-correct="checkCode" :game="'hangman'">
                <template v-slot:content>
                    <h2>Hangman</h2>
                    <p>Please type in the code you found on the poster. With this code you can start the game.</p>
                </template>
                <template v-slot:action>Continue</template>
            </first-popup>
        </transition>

        <transition name="fade">
            <second-popup v-if="!gameStarted && codeCorrect" class="absolute-center" @game-start="startGame">
                <template v-slot:content>
                    <h2>Hangman</h2>
                    <p>Type a letter and see if it occurs anywhere in the word. With this word you can continue your search!</p>
                </template>
                <template v-slot:action>Start game</template>
            </second-popup>
        </transition>

        <transition name="fade">
            <search-hangman v-if="gameStarted && !hangmanSolved">
            </search-hangman>
        </transition>

        <transition name="fade">
            <final-popup v-if="hangmanSolved" class="absolute-center">
                <template v-slot:content>
                    <h2>Congrats!</h2>
                    <p>The word from this game is "CHRISTMAS". How does it fit in the sentence with the other words of your quest. <br><br><strong>Good luck!</strong></p>
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
            codeCorrect: false,
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
        checkCode(){
            this.codeCorrect = true;
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