<template>
    <teleport to="#app">
        <div class="disco-container">
        </div>
    </teleport>
</template>

<script>
export default {
    mounted() {
        // Add disco lights to the body
        this.$bus.on('disableDiscoFX', () => {
            //console.log('Disabling disco lights');
            document.querySelector('.disco-container').style.display = 'none';
        });
        this.$bus.on('enableDiscoFX', () => {
            //console.log('Enabling disco lights');
            document.querySelector('.disco-container').style.display = 'flex';
        });
    }
};
</script>

<style scoped>
.disco-container {
    height: 200vh;
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    background-color: #000;
    font-size: 3rem;
    text-align: center;
    animation: discoLights 2s infinite;
    position: fixed;
    opacity: 0.25;
    z-index: 99999999;
    pointer-events: none;
    overflow: hidden;
    top: 0;
    left: 0;
}

/* Disco light animation */
@keyframes discoLights {
    0% {
        background-color: #ff0000;
        /* Red */
    }

    25% {
        background-color: #00ff00;
        /* Green */
    }

    50% {
        background-color: #0000ff;
        /* Blue */
    }

    75% {
        background-color: #ffff6b;
        /* Yellow */
    }

    100% {
        background-color: #ff00ff;
        /* Magenta */
    }
}
</style>
