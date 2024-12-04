<template>
    <transition name="fade-with-slide" mode="out-in">
        <template v-if="!hasSubmitted">
            <submit-popup>
                <template v-slot:content>
                    <h2>Submit sentence 🚀</h2>
                    <p>In the input field below, make the sentence with the 4 words!</p>
                </template>
                <template v-slot:action>Submit</template>
            </submit-popup>
        </template>
        <template v-else-if="submittedSentenceCorrect && !userInputtedEmail">
            <window-popup>
                <template v-slot:content>
                    <h2>Good Job!</h2>
                    <p>You have correctly guessed the sentence.</p>
                    <p>Enter your e-mail below and keep an eye on your inbox! Maybe you’ll be the lucky winner of a
                        special prize 😉.</p>
                </template>
                <template v-slot:input>
                    <input type="text" placeholder="Enter your e-mail" aria-label="E-mail" ref="shakeElement"
                        v-model="userEmail">
                    <button @click="handleEmailSubmit">Submit</button>
                </template>
                <template v-slot:audio>
                    <audio-player></audio-player>
                </template>
            </window-popup>
        </template>
        <template v-else-if="submittedSentenceCorrect && userInputtedEmail">
            <window-popup>
                <template v-slot:content>
                    <h2>Woop Woop</h2>
                    <p>You have correctly guessed the sentence.</p>
                    <p>We’ve got your email, so stay tuned for your prize 😉.</p>
                </template>
            </window-popup>
        </template>
        <template v-else>
            <negative-window-popup>
                <template v-slot:content>
                    <h2 class="error-text">Uh oh!</h2>
                    <p>Ah, that’s not quite what you’re looking for. You’re getting there, though, so don’t
                        give up!</p>
                </template>
                <template v-slot:action>
                    Try again
                </template>
                <template v-slot:action-two>
                    Go Home
                </template>
            </negative-window-popup>
        </template>
    </transition>
</template>




<script>
import confetti from "canvas-confetti";
import Cookies from 'js-cookie';
import axios from 'axios';
import gsap from 'gsap';
export default {
    data() {
        return {
            hasSubmitted: false,
            submittedSentenceCorrect: null,
            userInputtedEmail: false,
            userEmail: "",
        }
    },
    mounted() {
        this.$bus.on('submitSentence', () => {
            this.hasSubmitted = true;
            this.submittedSentenceCorrect = true;
            this.triggerConfetti();
        });
        this.$bus.on('submitRetry', () => {
            this.hasSubmitted = true;
            this.submittedSentenceCorrect = false;
        });
        this.$bus.on('submitRetryReset', () => {
            this.hasSubmitted = false;
            this.submittedSentenceCorrect = false;
        });
    },
    beforeUnmount() {
        this.$bus.off('submitSentence', this.handleSubmitSentence);
        this.$bus.off('submitRetry', this.handleSubmitRetry);
        this.$bus.off('submitRetryReset', this.handleSubmitRetryReset);
    },
    beforeMount() {
        //check if sentence has already been solved
        const cookieValue = Cookies.get('finalSentence');
        console.log(cookieValue);
        if (cookieValue === "found") {
            this.submittedSentenceCorrect = true;
            this.hasSubmitted = true;
        }
    },
    methods: {
        triggerConfetti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 },
            });
        },
        handleEmailSubmit() {
            //send email
            if (this.userInputtedEmail === null || this.userInputtedEmail === "") {
                this.triggerShake();
                return;
            }
            this.userInputtedEmail = true;

        },
        async triggerShake() {
            //animation
            await gsap.to(this.$refs.shakeElement, {
                duration: 0.1,
                x: 3,
                repeat: 4,
                yoyo: true,
                ease: "power2.inOut",
            });
            gsap.to(this.$refs.shakeElement, {
                duration: 0.1,
                x: 0,
                ease: "power2.inOut",
            });
        },
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

a {
    color: $color-turquoise-60;
    font-family: $red-hat-font;
    font-size: 16px;
    line-height: 24px;
    text-decoration: underline;
}
</style>