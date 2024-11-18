<template>
    <div class="wrapper">
        <div class="box-wrapper">
            <div class="box">
                <slot name="content"></slot>
            </div>
        </div>
        <div class="action">
            <button @click="emitGameStart">
                <slot name="action"></slot><i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        emitGameStart() {
            this.$emit('game-start');
        }
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    gap: 164px;
    width: 100%;

    @media (min-width: 768px) {
        width: 75%;
    }

    @media (min-width: 1024px) {
        width: 40%;
    }


    .box-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: $color-wit;
        border-radius: 20px;
        padding: 16px;
        text-align: center;
        box-shadow: 2px -4px 4px #00000042;


        .box {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
    }

    .action {
        width: 100%;
        text-align: center;
        display: flex;

        button {
            width: 100%;
        }

        i {
            margin-left: 16px;
        }
    }
}
</style>