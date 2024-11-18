<template>
    <header>
        <nav>
            <div class="branding">
                <img src="../../../public/logo-xmas.png" alt="">
            </div>
            <div class="icon" @click="toggleMobileNav">
                <i class="fa-solid fa-bars"></i>
                <div class="mobile-nav">
                    <transition name="mobile-nav">
                        <ul class="dropdown-nav" v-if="mobileNav">
                            <li class="underline">
                                <a href="/home" class="link"><i class="fas fa-house icon-space"></i>Home</a>
                            </li>
                            <li class="underline">
                                <a href="/explore" class="link"><i class="fas fa-search icon-space"></i>Explore</a>
                            </li>
                            <li class="underline">
                                <a href="/profile" class="link"><i class="far fa-user icon-space"></i>Profile</a>
                            </li>
                            <li class="underline">
                                <a href="/show_admin_dashboard" class="link"><i
                                        class="fas fa-dashboard icon-space"></i>Admin
                                    Dashboard</a>
                            </li>
                            <li class="underline">
                                <a href="/logout" class="link"><i
                                        class="fa-regular fa-circle-xmark icon-space"></i>Logout</a>
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
            mobileNav: false
        }
    },
    methods: {
        toggleMobileNav() {
            this.mobileNav = !this.mobileNav;
            console.log(this.mobileNav);
        }
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

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
                font-size: 28px;
            }
        }

        .mobile-nav {
            z-index: 9999;

            .dropdown-nav {
                z-index: 9999;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                position: fixed;
                width: 100%;
                max-width: 250px;
                height: 100vh;
                margin: 0;
                background: linear-gradient(to right,
                        $illustrations-medium-green 125px,
                        $illustrations-dark-green 125px) repeat-x;
                height: 100vh;
                margin: 0;
                background-size: 250px 100%;
                height: 100vh;
                margin: 0;
                padding: 0;
                top: 0;
                left: 0;
                transition: 0.5s ease all;

                li {
                    margin-right: 0;

                    .link {
                        color: black;
                    }
                }
            }

            .dropdown-nav-background {
                background-color: black;
                width: 100%;
                height: 100%;
                z-index: 10;
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
    transform: translateX(-250px);
}

.mobile-nav-enter-to {
    transform: translateX(0px);
}
</style>