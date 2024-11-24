<template>
    <div class="snowflakes-container">
        <div v-for="i in numSnowflakes" :key="i" class="snowflake" :style="generateSnowflakeStyle()">
            <span>*</span>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            numSnowflakes: 50, // Adjust the number of snowflakes
        };
    },
    methods: {
        generateSnowflakeStyle() {
            const xPos = Math.random() * 100 + '%';
            const delay = Math.random() * 5 + 's';
            const duration = Math.random() * 5 + 5 + 's';
            const size = Math.random() * 10 + 5 + 'px';

            return {
                left: xPos,
                animationDelay: delay,
                animationDuration: duration,
                fontSize: size,
            };
        },
    },
};
</script>

<style scoped lang="scss">
.snowflakes-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
}

.snowflake {
    position: absolute;
    top: -10px;
    opacity: 0;
    animation: snowAnimation linear infinite;

    span {
        color: white;
    }
}

@keyframes snowAnimation {
    0% {
        top: -10px;
        opacity: 0;
    }

    50% {
        opacity: 1;
    }

    100% {
        top: 100vh;
        /* Snowflakes fall to the bottom of the viewport */
        opacity: 0;
    }
}
</style>