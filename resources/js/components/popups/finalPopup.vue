<template>
    <div class="wrapper" role="dialog" aria-labelledby="popup-title" aria-hidden="true">
        <div class="box-wrapper">
            <div class="box" role="document">
                <h2 id="popup-title">Congratulations!</h2>
                <slot name="content"></slot>
            </div>
        </div>
        <div class="action">
            <slot name="action"></slot>
        </div>
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
    gap: 32px;
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