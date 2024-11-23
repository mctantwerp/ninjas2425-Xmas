<template>
    <transition name="fade-with-slide" mode="out-in">
        <template v-if="!hasSubmitted">
            <submit-popup>
                <template v-slot:content>
                    <h2>Submit sentence</h2>
                    <p>In the input field below, enter the sentence you found and see if you won!</p>
                </template>
                <template v-slot:action>Submit</template>
            </submit-popup>
        </template>
        <template v-else-if="submittedSentenceCorrect">
            <window-popup>
                <template v-slot:content>
                    <h2>Good Job!</h2>
                    <p>E-mail your answer to <a
                            href="mailto:britt.breugelmans@student.kdg.be">britt.breugelmans@student.kdg.be</a></p>
                    <p>Keep an eye on your inbox! Maybe you’ll be the lucky winner of a special prize 😉.</p>
                </template>
            </window-popup>
        </template>
        <template v-else>
            <negative-window-popup>
                <template v-slot:content>
                    <h2 class="error-text">Uh oh!</h2>
                    <p class>Ah, that’s not quite what you’re looking for. You’re getting there, though, so don’t
                        give up!
                    </p>
                </template>
                <template v-slot:action>
                    Try again
                </template>
            </negative-window-popup>
        </template>
    </transition>
</template>



<script>
import confetti from "canvas-confetti";
export default {
    data() {
        return {
            hasSubmitted: false,
            submittedSentenceCorrect: null,
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
    methods: {
        triggerConfetti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 },
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