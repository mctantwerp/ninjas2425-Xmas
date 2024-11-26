<template>
    <div class="image-container" @click="handleClick" ref="shakeElement">
        <div class="image" />
        <div class="overlay-box"></div>
        <teleport to=".game-container">
            <hint-popup>
                <template v-slot:bottom-text>
                    Tap on Santa’s items to reveal his frozen present.
                </template>
            </hint-popup>
        </teleport>
    </div>
</template>

<script>
import { gsap } from "gsap";
export default {
    methods: {
        correct() {
            this.$bus.emit('correct');
        },
        handleClick() {
            //if target contains overlay-box class, emit event
            if (!event.target.classList.contains('overlay-box')) {
                console.log('overlay-box clicked');
                this.triggerShake();
            }
            else {
                this.correct();
            }
        },
        async triggerShake() {
            //animation
            await gsap.to(this.$refs.shakeElement, {
                duration: 0.1,
                x: 6,
                y: 6,
                repeat: 4,
                yoyo: true,
                ease: "power2.inOut",
            });
            gsap.to(this.$refs.shakeElement, {
                duration: 0.1,
                x: 0,
                y: 0,
                ease: "power2.inOut",
            });
        },
    }
}
</script>

<style lang="scss" scoped>
.image-container {
    position: relative;
    /* Adjust height as needed */
    width: 100%;
    max-width: 320px;
    max-height: 590px;
    height: 590px;
    /* Ensures container spans full width */
    /* Center the background image */
}

.image {
    background-image: url('../assets/search-background.png');
    background-size: contain;
    /* Ensures image scales correctly */
    background-repeat: no-repeat;
    background-position: center;
    width: 100%;
    height: 100%;
}

.overlay-box {
    position: absolute;
    width: 50px;
    height: 50px;
    cursor: pointer;
    z-index: 10;
    background-color: red;
    opacity: 0.5;
    right: 40px;
    bottom: 140px;

    // @media (max-height: 740px) {
    //     bottom: 140px;
    // }

    // @media (max-height: 705px) {
    //     bottom: 135px;
    // }

    // @media (max-height: 670px) {
    //     bottom: 120px;
    //     right: 45px;
    // }

    // @media (max-height: 600px) {
    //     bottom: 105px;
    //     right: 55px;
    // }

    // @media (max-height: 550px) {
    //     height: 40px;
    //     width: 40px;
    //     right: 68px;
    //     bottom: 100px;
    // }
}
</style>