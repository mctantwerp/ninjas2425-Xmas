<template>
    <transition name="fade">
        <div class="screen-popup" v-show="userIsOnDesktop && !userIgnoredDesktopWarning" tabindex="-1"
            ref="desktopPopup">
            <div class="box">
                <h1>Hold! 🎄</h1>
                <p class="larger-paragraph">This website is optimized for mobile devices. For the best experience,
                    please visit this website on your mobile device.</p>
                <button @click="ignoreDesktopWarning">Continue anyway</button>
            </div>
        </div>
    </transition>
    <header>
        <nav>
            <div class="icon" @click="goHome" @keydown.enter="goHome" aria-label="Open navigation menu"
                aria-expanded="false" aria-controls="mobile-nav" tabindex="0" v-if="!userIsOnHome">
                <i class="fa-regular fa-angle-left"></i>
            </div>
            <div class="branding" @click="backToHome" aria-label="Go to homepage">
                <h1>{{ navbarTitle }}</h1>
            </div>
            <div class="icon" @click="toggleMobileNav" @keydown.enter="toggleMobileNav"
                aria-label="Open navigation menu" aria-expanded="false" aria-controls="mobile-nav" tabindex="0">
                <i class="fa-solid fa-bars" :class="{ 'icon-active': iconActive }"></i>
                <div class="mobile-nav" @click.stop>
                    <transition name="mobile-nav">
                        <ul class="dropdown-nav" v-if="mobileNav" @click.stop>
                            <h1 @click="goHome" @keydown.enter="goHome" tabindex="0" role="button"
                                aria-label="Go to homepage">Christmas Hunt</h1>

                            <li class="underline">
                                <a href="/tree" class="link" @click="navigateLink($event)"
                                    @keydown.enter="navigateLink($event)" aria-label="Navigate to Christmas Tree game">
                                    <img src="./assets/nav-tree.png" alt="Christmas Tree Icon">
                                    <span>Christmas Tree</span>
                                </a>
                            </li>

                            <li class="underline">
                                <a href="/search" class="link" @click="navigateLink($event)"
                                    @keydown.enter="navigateLink($event)" aria-label="Navigate to search game">
                                    <img src="./assets/nav-present.png" alt="Wrapped present icon.">
                                    <span>Search Game</span>
                                </a>
                            </li>
                            <li class="underline">
                                <a href="/rebus" class="link" @click="navigateLink($event)"
                                    @keydown.enter="navigateLink($event)" aria-label="Navigate to rebus game">
                                    <img src="./assets/nav-cup.png" alt="Hot chocolate cup icon.">
                                    <span>Rebus</span>
                                </a>
                            </li>
                            <li class="underline">
                                <a href="/hangman" class="link" @click="navigateLink($event)"
                                    @keydown.enter="navigateLink($event)" aria-label="Navigate to Hangman game">
                                    <img src="./assets/nav-ginger.png" alt="Gingerbread man icon.">
                                    <span>Hangman</span>
                                </a>
                            </li>
                            <li class="underline">
                                <a href="/howtoplay" class="link" @click="navigateLink($event)"
                                    @keydown.enter="navigateLink($event)" aria-label="Navigate to how to play page">
                                    <img src="./assets/nav-bell.png" alt="Bell icon for how to play page.">
                                    <span>How to play</span>
                                </a>
                            </li>
                            <li class="underline">
                                <a href="/submit" class="link" @click="navigateLink($event)"
                                    @keydown.enter="navigateLink($event)" aria-label="Navigate to submit sentence page">
                                    <img src="./assets/nav-santa.png" alt="Santa icon for submit page.">
                                    <span>Submit Sentence</span>
                                </a>
                            </li>
                        </ul>
                    </transition>
                    <transition name="fade">
                        <div class="dropdown-nav-background" v-if="mobileNav" @click="toggleMobileNav"
                            aria-label="Close navigation menu" aria-expanded="true" aria-controls="mobile-nav"></div>
                    </transition>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import Cookies from 'js-cookie';
export default {
    data() {
        return {
            mobileNav: false,
            iconActive: false,
            userIsOnDesktop: false,
            userIgnoredDesktopWarning: Cookies.get('acceptedDesktopWarning'),
            userIsOnHome: false
        }
    },
    props: {
        navbarTitle: {
            type: String,
            default: 'Christmas Hunt'
        }
    },
    methods: {
        toggleMobileNav() {
            this.mobileNav = !this.mobileNav;
            this.iconActive = !this.iconActive;
            this.$nextTick(() => {
                if (this.mobileNav) {
                    const firstLink = document.querySelector('.dropdown-nav a');
                    firstLink.focus();
                } else {
                    document.querySelector('.icon').focus();
                }
            });
        },
        ignoreDesktopWarning() {
            this.userIsOnDesktop = false;
            Cookies.set('acceptedDesktopWarning', 1, { expires: 14 });
        },
        backToHome() {
            window.location.href = '/';
        },
        handleEscKey(event) {
            if (event.key === 'Escape') {
                this.toggleMobileNav();
            }
        },
        navigateLink(event) {
            event.preventDefault();
            const link = event.target.closest('a');
            window.location.href = link.href;
            this.mobileNav = true;
        },
        goHome() {
            window.location.href = '/';
        }
    },
    mounted() {
        if (window.innerWidth > 1024) {
            this.userIsOnDesktop = true;
        }
        if (this.userIsOnDesktop) {
            this.$nextTick(() => {
                this.$refs.desktopPopup.focus();
            });
        }
        window.addEventListener('keydown', this.handleEscKey);

    },
    beforeMount() {
        if (window.location.pathname === '/') {
            this.userIsOnHome = true;
        }
    },
    beforeDestroy() {
        window.removeEventListener('keydown', this.handleEscKey);
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

        .branding {
            height: 27.4px;
            cursor: pointer;

            img {
                width: 100%;
                height: fit-content;
            }

            h1 {
                display: inline-block;
                vertical-align: middle;
                transform: translateY(18%);
            }
        }

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
                // background: linear-gradient(to right,
                //         $illustrations-medium-green 50%,
                //         $illustrations-dark-green 50%) repeat-x;
                margin: 0;
                // background-size: 125px 100%;
                background-color: $illustrations-dark-green;
                padding: 0;
                top: 0;
                right: 0;
                transition: 0.5s ease all;
                overflow-y: auto;
                max-width: 250px;
                box-shadow: -1px 2px 10px rgb(0, 0, 0, 0.5);


                .underline {
                    width: 90%;
                    padding: 16px 0px 16px 8px;
                    border-bottom: 2px solid $color-wit;
                    margin-bottom: 8px;

                    .link {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        text-decoration: none;
                        color: inherit;

                        span {
                            font-family: $braah-font;
                            font-size: 16px;
                            line-height: 24px;
                            color: $color-wit;
                            text-decoration: none;
                        }
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