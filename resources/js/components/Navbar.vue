<template>
    <transition name="fade">
        <div class="screen-popup" v-show="userIsOnDesktop">
            <div class="box">
                <h1>Hold! 🎄</h1>
                <p class="larger-paragraph">We've noticed you're visiting the website on a desktop. This website is
                    primarily
                    designed for mobile and
                    thus the website might not work as expected.</p>
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
    position: fixed;
    width: 90%;
    top: 0;
    z-index: 99;

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
                font-size: 24px;
                transition: 0.5s ease all;
                cursor: pointer;
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
                gap: 32px;

                .underline {
                    display: flex;
                    flex-direction: row;
                    gap: 16px;
                    align-items: center;

                    img {
                        margin-left: 16px;
                    }
                }

                li {
                    margin-right: 0;

                    .link {
                        color: $color-wit;
                    }
                }

                h1 {
                    margin: 128px 0px 228px 0px;
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
                z-index: -10;
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