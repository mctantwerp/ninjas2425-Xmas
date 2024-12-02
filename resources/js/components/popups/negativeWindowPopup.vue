<template>
    <div class="wrapper">
        <div class="box-wrapper">
            <div class="box">
                <slot name="content"></slot>
            </div>
        </div>
        <div class="buttons-wrapper">
            <div class="action">
                <button ref="retryButton" @click="submitRetry" aria-label="Retry the game" tabindex="0">
                    <slot name="action"></slot>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <div>
                <button ref="retryButton" @click="goHome" aria-label="Retry the game" tabindex="0">
                    <slot name="action-two"></slot>
                    <i class="fa-regular fa-house-blank"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        submitRetry() {
            this.$bus.emit('submitRetryReset');
        },
        goHome() {
            window.location.href = '/';
        },
    },
}
</script>

<style lang="scss" scoped>
@import "../../../sass/variables.scss";

.wrapper {
    display: flex;
    flex-direction: column;
    gap: 32px;
    width: 80vw;
    max-width: 600px;

    .buttons-wrapper {
        display: flex;
        flex-direction: column;
        gap: 16px;
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
            color: $color-input-error-highcontrast-text;
        }

        i {
            margin-left: 16px;
        }
    }
}
</style>