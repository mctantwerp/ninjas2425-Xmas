<template>
    <div class="image-container" @click="handleClick" ref="shakeElement">
        <img src="../assets/search-background.png"
            alt="search game background image with many icons like presents and others" class="image" />
        <div class="overlay-box"></div>
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
    display: inline-block;
    height: 80vh;
}

.image {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.overlay-box {
    position: absolute;
    bottom: 22%;
    right: 11%;
    width: 70px;
    height: 70px;
    cursor: pointer;
    z-index: 10;
    background-color: red;
    opacity: 0.5;

    @media(max-width: 410px) {
        width: 65px;
        height: 65px;
        bottom: 23%;
    }

    @media(max-width: 360px) {
        width: 65px;
        height: 65px;
        bottom: 26%;
    }

    @media(max-width: 340px) {
        width: 50px;
        height: 50px;
        bottom: 29%;
    }

    @media(max-width: 320px) {
        width: 50px;
        height: 50px;
        bottom: 28%;
    }
}
</style>