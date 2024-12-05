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
                    <i class="fa-regular fa-trash-can" @click="clearInput" @keydown.enter.prevent="clearInput"
                        @touchstart.prevent="clearInput" aria-label="Clear input" role="button" tabindex="0">
                    </i>
                </template>
                <template v-slot:error>
                    <transition name="fade">
                        <span v-if="responseMessage !== null" class="error" id="error-message" role="alert"
                            aria-live="assertive">
                            {{ responseMessage }}
                        </span>
                    </transition>
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
                    <h2>Woop Woop! 🎉</h2>
                    <p>Thank you for submitting your email!</p>
                    <p>We'll be selecting random winners soon and reaching out to them via email, so keep an eye on your
                        inbox! 😉</p>
                    <p>In the meantime, crank up the volume and enjoy some special MCT celebration music! 🎶</p>

                </template>
                <template v-slot:action>
                    <button @click="disableDiscoFX">{{ buttonText }}<i class="fa-regular fa-party-horn"></i></button>
                    <a href="/" class="button-spacing"><button>Go Home<i
                                class="fa-regular fa-house-blank"></i></button></a>
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
            responseMessage: null,
            showDisco: true,
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
                this.responseMessage = 'E-mail cannot be empty.';
                this.triggerShake();
                setTimeout(() => {
                    this.responseMessage = null;
                }, 2250);
                return;
            }
            if (!emailRegex.test(this.userEmail)) {
                this.responseMessage = 'Invalid e-mail format.';
                this.triggerShake();
                setTimeout(() => {
                    this.responseMessage = null;
                }, 2250);
                return;
            }
            try {
                const response = await axios.post('/api/save-email', {
                    email: this.userEmail,
                });

                if (response.status === 200) {
                    console.log("Email saved successfully:", response.data.message);
                    this.userInputtedEmail = true;
                    Cookies.set('emailSubmitted', true);

                }
            } catch (error) {
                if (error.response) {
                    console.error("Error saving email:", error.response.data.message);
                    this.responseMessage = 'Error saving email. Please try again.';
                    setTimeout(() => {
                        this.responseMessage = null;
                    }, 2250);
                    if (error.response.status === 400) {
                        console.error("Invalid request. Please check the input.");
                        this.responseMessage = 'Invalid request. Please check the input.';
                        setTimeout(() => {
                            this.responseMessage = null;
                        }, 2250);
                    } else if (error.response.status === 500) {
                        console.error("A server error occurred. Please try again later.");
                        this.responseMessage = 'A server error occurred. Please try again later.';
                        setTimeout(() => {
                            this.responseMessage = null;
                        }, 2250);
                    }
                } else {
                    console.error("Unexpected error:", error.message);
                }
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
        disableDiscoFX() {
            this.showDisco = !this.showDisco;
            if (this.showDisco) {
                this.$bus.emit('enableDiscoFX');
            }
            else {
                this.$bus.emit('disableDiscoFX');
            }
        },
        clearInput() {
            this.userEmail = "";
        },
    },
    computed: {
        buttonText() {
            return this.showDisco ? "Disable Disco" : "Enable Disco";
        }
    },
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

:deep(.dancing-gif) {
    height: 150px;
    width: 25%;
    object-fit: contain;
    margin: 0 auto;
}

:deep(.input) {

    input {
        position: relative;
    }

    i {
        position: absolute;
        right: 24px;
        color: $color-rood-40;
        font-size: 16px;
        padding: 8px;
    }
}

.button-spacing {
    margin-bottom: 100px;
}
</style>