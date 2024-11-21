<template>
    <transition name="fade">
        <first-popup @game-start="startGame" v-if="!gameStarted">
            <template v-slot:content>
                <h2>Rebus</h2>
                <p>Can you figure out what message is encoded in these images? Find the secret two words!</p>
            </template>
            <template v-slot:action>Continue</template>
        </first-popup>
    </transition>
    <transition name="fade">
        <search-rebus v-if="gameStarted && !correctAnswer"></search-rebus>
    </transition>
    <transition name="fade">
        <final-popup v-if="correctAnswer">
            <template v-slot:content>
                <h2>Congrats!</h2>
                <p>The words in this game are "NXT Media". Good luck with the rest of the game!</p>
            </template>
            <template v-slot:action>Submit sentence</template>
        </final-popup>
    </transition>
</template>

<script>
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
        });
    },
    methods: {
        startGame() {
            this.gameStarted = true;
            document.getElementsByClassName('snow')[0].style.display = "none";
            document.getElementsByClassName('gingerman')[0].style.display = "none";
            document.getElementsByClassName('candy')[0].style.display = "none";
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

<style lang="scss"></style>