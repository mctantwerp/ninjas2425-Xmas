<template>
    <div class="wrapper">
        <div class="box-wrapper">
            <div class="box">
                <slot name="content"></slot>
            </div>
        </div>
        <div class="container-input">
            <div class="input" ref="shakeElement">
                <input type="text" placeholder="Type sentence here" v-model="userInput" aria-label="Type your sentence">
                <i class="fa-regular fa-trash-can" @click="clearInput" @keydown.enter="clearInput" tabindex="0"
                    aria-label="Clear input"></i>
            </div>
        </div>
        <div class="action">
            <button @click="submitSentence" @keydown.enter="submitSentence" aria-label="Submit your sentence">
                <slot name="action"></slot><i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import gsap from 'gsap';
import Cookies from 'js-cookie';

export default {
    props: {
        game: {
            type: String,
        }
    },
    data() {
        return {
            userInput: "",
            result: "",
            responseMessage: null,
        }
    },
    methods: {
        async submitSentence() {
            //this.triggerShake();
            ///checkFinalSentence
            try {
                if (this.userInput === '') {
                    this.triggerShake();
                    return;
                }
                const response = await axios.post('/api/checkFinalSentence', {
                    finalSentence: this.userInput,
                });
                const result = response.data.result;
                console.log(result);
                if (result) {
                    Cookies.set('finalSentence', 'found', { expires: 14 });
                    this.$bus.emit('submitSentence');
                }
                else {
                    this.$bus.emit('submitRetry');
                }
            }
            catch (error) {

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
        clearInput() {
            console.log("clear input");
            this.userInput = "";
        },
    },
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.wrapper {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;

    .container-input {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .input {
        position: relative;
        display: flex;
        flex-direction: row;
        align-items: center;

        i {
            color: $color-rood-40;
            font-size: 16px;
            position: absolute;
            right: 24px;
            padding: 8px;
        }
    }

    .box-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: $color-wit;
        border-radius: 20px;
        text-align: center;
        box-shadow: 2px -4px 4px #00000042;
        margin-bottom: 24px;


        .box {
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding: 32px;
        }
    }

    .action {
        width: 100%;
        text-align: center;
        display: flex;

        button {
            width: 100%;
        }

        i {
            margin-left: 16px;
        }
    }
}
</style>