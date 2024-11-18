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
        <search-rebus v-if="gameStarted"></search-rebus>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            gameStarted: false,
            isDesktop: window.innerWidth > 1024,
        }
    },
    computed: {
        viewportWidth() {
            return window.innerWidth;
        }
    },
    mounted() {
        window.addEventListener('resize', this.checkViewport);
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
    destroyed() {
        // Remove event listener when the component is destroyed
        window.removeEventListener('resize', this.checkViewport);
    },
}
</script>

<style lang="scss"></style>