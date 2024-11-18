<template>
    <header>
        <nav>
            <div class="branding">
                <img src="../../../public/logo-xmas.png" alt="">
            </div>
            <div class="icon">
                <i class="fa-solid fa-bars"></i>
            </div>
        </nav>
    </header>
</template>

<script setup>

</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

nav {
    height: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;

    .branding {}

    .icon {
        height: 35px;
        width: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: $color-wit;
        padding: 4px;
        box-shadow: inset 2px -4px 3px rgba(0, 0, 0, 0.253);
        border-radius: 12px;

        i {
            color: $color-black;
            font-size: 28px;
        }
    }
}
</style>