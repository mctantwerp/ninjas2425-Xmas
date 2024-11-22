<template>
    <submit-popup v-if="!hasSubmitted">
        <template v-slot:content>
            <h2>Submit sentence</h2>
            <p>In the input field below, enter the sentence you found and see if you won!</p>
        </template>
        <template v-slot:action>Submit</template>
    </submit-popup>
    <window-popup v-if="hasSubmitted && !submittedSentence">
        <template v-slot:content>
            <h2>Good Job!</h2>
            <p>E-mail your answer to <a
                    href="mailto:britt.breugelmans@student.kdg.be">britt.breugelmans@student.kdg.be</a></p>
            <p>Keep an eye on your inbox! Maybe you’ll be the lucky winner of a special prize 😉.</p>
        </template>
    </window-popup>
    <negative-window-popup v-if="hasSubmitted && submittedSentence">
        <template v-slot:content>
            <h2>Uh oh!</h2>
            <p>Ah, that’s not quite what you’re looking for. You’re getting there, though, so don’t give up!</p>
        </template>
        <template v-slot:action>
            Try again
        </template>
    </negative-window-popup>
</template>

<script>
export default {
    data() {
        return {
            hasSubmitted: false,
            submittedSentence: true,
        }
    },
    mounted() {
        this.$bus.on('submitSentence', () => {
            this.hasSubmitted = true;
        });
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
</style>