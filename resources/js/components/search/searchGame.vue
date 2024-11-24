<template>
    <div class="image-container">
        <img src="../assets/search-background.png"
            alt="search game background image with many icons like presents and others" class="image" />
        <div class="overlay-box" @click="correct"></div>
    </div>
</template>

<script>
export default {
    methods: {
        correct() {
            this.$bus.emit('correct');
        }
    }
}
</script>

<style lang="scss" scoped>
.image-container {
    position: relative;
    display: inline-block;
}

.image {
    display: block;
    width: 100%;
    height: auto;
}

.overlay-box {
    position: absolute;
    bottom: 130px;
    right: 32px;
    width: 70px;
    height: 70px;
    cursor: pointer;
    z-index: 10;
}
</style>