<template>
    <div class="game-container">
        <transition name="fade-with-slide" mode="out-in">
            <first-popup v-if="!gameStarted" @game-start="startGame" :game="'hangman'">
                <template v-slot:content>
                    <h2>hangman 😲</h2>
                    <p>Type a letter and see if it occurs anywhere in the word. With this word you can continue your search! 18M12</p>
                </template>
                <template v-slot:action>Continue</template>
            </first-popup>

            <hangman-game v-else-if="gameStarted && !hangmanSolved"></hangman-game>
            
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
    }
}
</script>

<style scoped>
</style>