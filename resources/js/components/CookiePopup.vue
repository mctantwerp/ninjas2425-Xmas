<template>
    <div v-if="hasMounted">
        <transition name="fade" mode="out-in">
            <vue-cookie-comply v-if="!userHasAcceptedCookies" position="bottom" accept-button-text="Accept"
                decline-button-text="Decline" background-color="#f5f5f5" text-color="#333" button-color="#007bff"
                button-text-color="#fff" target="#app" :preferences="preferencesCookies"
                @on-accept-all-cookies="onAccept" @on-save-cookie-preferences="onSavePreferences">
                <template v-slot:header>
                    <header>
                        <h3 class="cookie-comply__header-title">🍪 Cookie Settings</h3>
                        <p class="cookie-comply__header-description">We use cookies and similar technologies to help
                            personalize content and offer a better
                            experience. You can opt to customize them by clicking the preferences button.</p>
                    </header>
                </template>
            </vue-cookie-comply>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            preferencesCookies: [
                {
                    title: '🍪 Functional Cookies',
                    description:
                        'Functional cookies are necessary for the website to function correctly.',
                    items: [{ label: 'Game Rememberer', value: 'Functional', isRequired: true }],
                },
                {
                    title: 'Analytics',
                    description:
                        'The analytics cookies will be used to improve the user experience. With this data, we can make adjustments to the website to make your experience even better!',
                    items: [
                        { label: 'Hotjar - Track User Flow', value: 'hotjar', isEnable: true },
                    ],
                },
            ],
            userHasAcceptedCookies: false,
            hasMounted: false,
        }
    },
    methods: {
        onAccept() {
            window.dispatchEvent(new CustomEvent('cookies-accepted'));
            this.userHasAcceptedCookies = true;
        },
        onSavePreferences(preferences) {
            if (preferences[1] === 'hotjar') {
                window.dispatchEvent(new CustomEvent('hotjar-accepted-true'));
                this.userHasAcceptedCookies = true;
            }
        },
    },
    mounted() {
        this.hasMounted = true;
        let rawCookieComply = localStorage.getItem('cookie-comply');
        if (rawCookieComply !== null) {
            this.userHasAcceptedCookies = true;
        }
    },
};
</script>



<style>
@import '../../../node_modules/vue-cookie-comply/dist/style.css';

/* .cookie-wrapper {
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 9999;
} */
</style>