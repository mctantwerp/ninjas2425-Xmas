<template>
    <div class="wrapper">
        <div class="box-wrapper">
            <div class="box">
                <slot name="content"></slot>
            </div>
        </div>
        <div class="container-input">
            <div class="input" ref="shakeElement">
                <input type="text" placeholder="Enter code from poster" v-model="userInput">
                <i class="fa-regular fa-trash-can" @click="clearInput"></i>
            </div>
            <transition name="fade">
                <span class="error" v-if="responseMessage !== null">{{ responseMessage }}</span>
            </transition>
        </div>
        <div class="action">
            <button @click="emitGameStart">
                <slot name="action"></slot><i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import gsap from 'gsap';
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
        async emitGameStart() {
            try {
                //if input is empty, shake and return
                if (this.userInput === "") {
                    this.triggerShake();
                    return;
                }
                const response = await axios.post('/api/checkEntry', {
                    game: this.game,
                    enterd_key: this.userInput,
                });
                this.result = response.data.passwordCorrect;
                if (this.result) {
                    this.$emit('game-start');
                }
                else {
                    this.responseMessage = 'The code you entered is incorrect.';
                    this.userInput = "";
                    setTimeout(() => {
                        this.responseMessage = null;
                    }, 2250);
                    this.triggerShake();
                }
            } catch (error) {
                console.error('Error sending data:', error);
                this.responseMessage = 'Error submitting the word.';
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
            this.userInput = "";
        },
    },
    mounted() {
        console.log(this.game);
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.wrapper {
    display: flex;
    flex-direction: column;
    gap: 32px;
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
        padding: 16px;
        text-align: center;
        box-shadow: 2px -4px 4px #00000042;


        .box {
            display: flex;
            flex-direction: column;
            gap: 16px;
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