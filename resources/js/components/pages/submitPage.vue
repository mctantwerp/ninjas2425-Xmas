<template>
    <transition name="fade-with-slide" mode="out-in">
        <template v-if="!hasSubmitted" key="submit">
            <submit-popup>
                <template v-slot:content>
                    <h2>Submit sentence 🚀</h2>
                    <p>In the input field below, make the sentence with the 4 words!</p>
                </template>
                <template v-slot:action>Submit</template>
            </submit-popup>
        </template>
        <template v-else-if="submittedSentenceCorrect && !userInputtedEmail" key="email">
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
                </template>
                <template v-slot:action>
                    <button @click="handleSubmitEmail">Submit</button>
                </template>
            </window-popup>
        </template>
        <template v-else-if="submittedSentenceCorrect && userInputtedEmail" key="audio">
            <window-popup>
                <template v-slot:gifs>
                    <img class="dancing-gif" src="../assets/dancing-man2-scaled.gif">
                    <img class="dancing-gif" src="../assets/dancing-man-scaled.gif">
                </template>
                <template v-slot:content>
                    <h2>Woop Woop</h2>
                    <p>You have correctly guessed the sentence.</p>
                    <p>We will draw random winners soon and contact them by e-mail, so be sure to keep a watch on your
                        inbox 😉.</p>
                    <p>And most importantly, turn up your volume for some special MCT celebration music!</p>
                </template>
                <template v-slot:action>
                    <a href="/"><button class="button-spacing">Go Home</button></a>
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
    <transition name="fade">
        <template v-if="submittedSentenceCorrect && userInputtedEmail">
            <audio-player></audio-player>
        </template>
    </transition>
    <transition name="fade">
        <template v-if="submittedSentenceCorrect && userInputtedEmail">
            <disco-dasco></disco-dasco>
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
        async handleSubmitEmail() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (this.userEmail === null || this.userEmail === "") {
                this.triggerShake();
                return;
            }
            if (!emailRegex.test(this.userEmail)) {
                this.triggerShake();
                return;
            }

            try{
                const response = await axios.post('/api/save-email', {
                    email: this.userEmail,
                });
                console.log("test");
                Cookies.set('finalSentence', "found");
                Cookies.set('emailSubmitted', "true");
                this.submittedSentenceCorrect = true;
                this.hasSubmitted = true;
                this.userInputtedEmail = true;
            }
            catch (error) {
                console.error('Error sending data:', error);
            }
            
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

::v-deep .dancing-gif {
    height: 150px;
    width: 25%;
    object-fit: contain;
    margin: 0 auto;
}

.button-spacing {
    margin-bottom: 100px;
}
</style>