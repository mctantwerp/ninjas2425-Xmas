<template>
    <div class="rebus-wrapper">
        <div class="images-rebus">
            <div class="top-row">
                <img src="../assets/rebus-first.png" alt="">
                <i class="fa-light fa-plus"></i>
                <img src="../assets/rebus-second.png" alt="">
                <i class="fa-light fa-plus"></i>
                <img src="../assets/rebus-third.png" alt="">
            </div>
            <div class="bottom-row">
                <i class="fa-light fa-plus"></i>
                <img src="../assets/rebus-fourth.png" alt="">
            </div>
        </div>
        <div class="input" ref="shakeElement">
            <input type="text" :placeholder="inputPlaceholder" v-model="userInput">
            <i class="fa-regular fa-trash-can" @click="clearInput"></i>
        </div>
        <div class="action">
            <button @click="checkWord">Submit
                <i class="fa-regular fa-gift"></i>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { gsap } from "gsap";

export default {
    data() {
        return {
            userInput: '',
            inputPlaceholder: 'Type your word here!',
        }
    },
    methods: {
        clearInput() {
            console.log('clear input');
            this.userInput = '';
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
        async checkWord() {
            try {
                const response = await axios.post('/api/checkRebus', {
                    word: this.userInput,
                });

                const { result } = response.data;

                if (result) {
                    console.log('Word is correct!');
                    this.$bus.emit('correct');
                } else {
                    this.triggerShake();
                    console.log('Word is incorrect.');
                    this.generateRandomPlaceholder();
                }
            } catch (error) {
                console.error('Error sending data:', error);
                this.responseMessage = 'Error submitting the word.';
            }
            this.clearInput();
        },
        generateRandomPlaceholder() {
            const placeholders = [
                "Nice try!",
                "Keep going!",
                "Don't quit now!",
                "Don't give up!",
            ];
            const randomIndex = Math.floor(Math.random() * placeholders.length);
            this.inputPlaceholder = placeholders[randomIndex];
        }
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.rebus-wrapper {
    display: flex;
    flex-direction: column;
    gap: 32px;
    width: 100%;
    text-align: center;

    .images-rebus {
        display: flex;
        flex-direction: column;
        gap: 32px;
        justify-content: center;
        align-items: center;

        .top-row {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            gap: 16px;
            flex-wrap: wrap;

            img {
                width: calc(25% - 10px);
            }
        }

        .bottom-row {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 16px;

            img {
                width: calc(75% - 10px);
            }

        }

        i {
            color: $color-wit;
            font-size: 24px;
        }

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

    .action {
        display: flex;
        width: 100%;
        text-align: center;

        button {
            width: 100%;
        }
    }
}
</style>