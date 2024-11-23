<template>
    <transition name="fade">
        <div class="screen-popup" v-show="userIsOnDesktop">
            <div class="box">
                <h1>Hold! 🎄</h1>
                <p class="larger-paragraph">We've noticed you're visiting the website on a desktop. This website is
                    primarily
                    designed for mobile and
                    thus the website might not work and/or look as expected.</p>
                <button @click="ignoreDesktopWarning">Continue anyway</button>
            </div>
        </div>
    </transition>
    <header>
        <nav>
            <div class="branding">
                <img src="../../../public/logo-xmas.png" alt="">
            </div>
            <div class="icon" @click="toggleMobileNav">
                <i class="fa-solid fa-bars" :class="{ 'icon-active': iconActive }"></i>
                <div class="mobile-nav" @click.stop>
                    <transition name="mobile-nav">
                        <ul class="dropdown-nav" v-if="mobileNav" @click.stop>
                            <h1>Christmas Hunt</h1>
                            <li class="underline">
                                <img src="./assets/nav-tree.png">
                                <a href="/tree" class="link">Christmas Tree</a>
                            </li>
                            <li class="underline">
                                <img src="./assets/nav-present.png">
                                <a href="/search" class="link">Search Game</a>
                            </li>
                            <li class="underline">
                                <img src="./assets/nav-cup.png">
                                <a href="/rebus" class="link">Rebus</a>
                            </li>
                            <li class="underline">
                                <img src="./assets/nav-ginger.png">
                                <a href="/hangman" class="link">Hangman</a>
                            </li>
                            <li class="underline">
                                <img src="./assets/nav-bell.png">
                                <a href="/howtoplay" class="link">How to play</a>
                            </li>
                            <li class="underline">
                                <img src="./assets/nav-santa.png">
                                <a href="/submit" class="link">Submit Sentence</a>
                            </li>
                        </ul>
                    </transition>
                    <transition name="fade">
                        <div class="dropdown-nav-background" v-if="mobileNav" @click="toggleMobileNav"></div>
                    </transition>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    data() {
        return {
            mobileNav: false,
            iconActive: false,
            userIsOnDesktop: false
        }
    },
    methods: {
        toggleMobileNav() {
            this.mobileNav = !this.mobileNav;
            this.iconActive = !this.iconActive;
        },
        ignoreDesktopWarning() {
            this.userIsOnDesktop = false;
        }
    },
    mounted() {
        if (window.innerWidth > 1024) {
            this.userIsOnDesktop = true;
        }
    },
}
</script>

<style lang="scss" scoped>
@import "../../sass/_variables.scss";

.screen-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: $color-wit;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 16px;
    z-index: 9999;
    text-align: center;

    .box {
        margin: 64px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 16px;

        h1 {
            font-size: 2rem;
            color: $color-black;
        }

        p {
            font-size: 24px;
            text-align: center;
        }

        button {
            margin-top: 16px;
        }
    }
}

header {
    margin: 0 auto;
    width: 100%;
    z-index: 99;
    position: fixed;
    top: 0;
    left: 0;
    height: 76px;
    background-color: rgba(16, 107, 92, 0.335);
    backdrop-filter: blur(10px);

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        border-bottom: 1px solid $color-wit;

        .branding {}

        .icon {
            height: 39px;
            width: 39px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: $color-wit;
            box-shadow: inset 2px -4px 3px rgba(0, 0, 0, 0.253);
            border-radius: 12px;
            cursor: pointer;

            i {
                color: $color-black;
                font-size: 24px;
                transition: 0.5s ease all;
            }
        }

        .icon-active {
            transform: rotate(180deg);
        }

        .mobile-nav {

            .dropdown-nav {
                z-index: 9999;
                display: flex;
                flex-direction: column;
                justify-content: start;
                align-items: center;
                position: fixed;
                width: 60%;
                height: 100vh;
                background: linear-gradient(to right,
                        $illustrations-medium-green 125px,
                        $illustrations-dark-green 125px) repeat-x;
                margin: 0;
                background-size: 250px 100%;
                padding: 0;
                top: 0;
                right: 0;
                transition: 0.5s ease all;
                overflow-y: auto;


                .underline {
                    display: flex;
                    flex-direction: row;
                    gap: 16px;
                    align-items: center;
                    justify-content: start;
                    width: 90%;
                    padding: 16px 0px 16px 8px;
                    border-bottom: 2px solid $color-wit;
                    margin-bottom: 8px;

                    img {}

                    a {
                        font-size: 16px
                    }

                    &:last-child {
                        border-bottom: none;
                        margin-bottom: none;
                    }
                }

                li {
                    margin-right: 0;

                    .link {
                        color: $color-wit;
                    }
                }

                h1 {
                    margin: 32px 0px 32px 0px;
                    border-bottom: 2px solid $color-wit;
                    width: 100%;
                    text-align: center;
                }
            }

            .dropdown-nav-background {
                position: fixed;
                top: 0;
                right: 0;
                background-color: rgba(0, 0, 0, 0.50);
                width: 100vw;
                height: 100vh;
                z-index: 0;
            }
        }
    }
}

.mobile-nav-enter-active,
.mobile-nav-leave-active {
    transition: 0.25s ease all;
}

.mobile-nav-enter-from,
.mobile-nav-leave-to {
    transform: translateX(100vw);
}

.mobile-nav-enter-to {
    transform: translateX(0px);
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>