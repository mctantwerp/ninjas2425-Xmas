<template>
    <transition name="fade-high-index">
        <div v-if="hintVisible" class="hint-container" role="dialog" aria-labelledby="hint-title"
            aria-describedby="hint-description" tabindex="0">
            <div class="hint-wrapper">
                <i class="fa-solid fa-x" @click="toggleHint" aria-label="Close hint"></i>
                <div class="top">
                    <h1 id="hint-title">Hint!</h1>
                </div>
                <div class="bottom">
                    <p id="hint-description">
                        <slot name="bottom-text"></slot>
                    </p>
                    <button @click="toggleHint" aria-label="Got it!">Got it!</button>
                </div>
            </div>
        </div>
        <div v-else-if="showHintIcon" class="hint-icon" @click="toggleHint" aria-label="Show hint" role="button"
            tabindex="0" @keydown.enter.prevent="toggleHint">
            <i class="fa-solid fa-question"></i>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            hintVisible: false,
            showHintIcon: false,
        };
    },
    mounted() {
        //added timer to not cause conflicts with vue transition -- didnt know how to fix it so thought of this... lol
        setTimeout(() => {
            this.showHintIcon = true;
        }, 500);
        window.addEventListener('keydown', this.handleEscapeKey);
    },
    methods: {
        toggleHint() {
            this.hintVisible = !this.hintVisible;
            if (this.hintVisible) {
                //focus the got it button when the hint is visible
                this.$nextTick(() => {
                    this.$el.querySelector('button').focus();
                });
            }
        },
        handleEscapeKey(event) {
            if (event.key === 'Escape' && this.hintVisible) {
                this.toggleHint();
            }
        },
    },
};
</script>


<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.hint-icon {
    position: fixed;
    right: 16px;
    top: 80px;
    width: 40px;
    height: 40px;
    background-color: $color-turquoise-90;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
    z-index: 1000;
    cursor: pointer;

    i {
        color: $color-wit;
    }
}

.hint-wrapper {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: $illustrations-dark-green;
    z-index: 1001;
    border-radius: 12px;
    min-width: 290px;

    p,
    h1 {
        color: $color-wit;
        text-align: center;
    }

    button {
        color: $illustrations-dark-green;
        text-align: center;
        height: 56px;
    }

    i {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: $color-wit;
        color: $color-black;
        position: absolute;
        right: 0px;
        height: 50.59px;
        width: 60px;
        border-top-right-radius: 12px;
        font-size: 24px;
    }

    .top {
        display: flex;
        justify-content: center;
        border-bottom: 1px solid $color-wit;

        h1 {
            padding: 16px 16px 0px 16px;
        }

    }

    .bottom {
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

}

.hint-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.351);
    z-index: 199;
}
</style>