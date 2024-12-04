<template>
    <div class="wrapper">
        <div class="top-wrapper">
            <slot name="gifs"></slot>
        </div>
        <div class="box-wrapper">
            <div class="box">
                <slot name="content"></slot>
            </div>
        </div>
        <div class="input">
            <slot name="input"></slot>
        </div>
        <div class="action">
            <slot name="action"></slot>
        </div>
        <slot name="audio"></slot>
    </div>
</template>

<script>
export default {
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.wrapper {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;

    .top-wrapper {
        display: flex;
        flex-direction: row;
        width: 100%;
    }

    .input {
        position: relative;
        display: flex;
        flex-direction: row;
        align-items: center;

        i {
            color: $color-rood-40;
            font-size: 16px;
            position: absolute;
            right: 24px;
            padding: 8px;
        }
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
        margin-bottom: 24px;


        .box {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
    }
}
</style>