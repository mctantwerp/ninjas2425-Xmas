<template>
    <div class="rebus-wrapper">
        <div class="images-rebus">
            <img src="../assets/rebus-problem.png"
                alt="Rebus puzzle showing a hat with 'T' removed, an upward arrow with 'U' removed, a pi symbol with 'I' removed, and the letter 'Y' added">
        </div>
        <div class="input" ref="shakeElement">
            <label for="user-input" class="sr-only">Your Answer</label>
            <input type="text" :placeholder="inputPlaceholder" v-model="userInput">
            <i class="fa-regular fa-trash-can" @click="clearInput" aria-label="Clear input"></i>
        </div>
        <div class="action">
            <button @click="checkWord" aria-label="Submit answer">Submit
                <i class="fa-regular fa-gift"></i>
            </button>
        </div>
        <teleport to=".game-container">
            <hint-popup>
                <template v-slot:bottom-text>
                    Don't overthink it!
                </template>
            </hint-popup>
        </teleport>
    </div>
</template>

<script>
import axios from 'axios';
import { gsap } from "gsap";
import Cookies from 'js-cookie';

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
                if (this.userInput === '') {
                    this.triggerShake();
                    return;

                }
                const response = await axios.post('/api/checkRebus', {
                    word: this.userInput,
                });

                const { result } = response.data;

                if (result) {
                    console.log('Word is correct!');
                    Cookies.set('rebusSolved', 1, { expires: 14 });
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
    gap: 8px;
    width: 100%;
    text-align: center;

    .images-rebus {
        display: flex;
        flex-direction: column;
        gap: 32px;
        justify-content: center;
        align-items: center;
        margin-bottom: 32px;

        img {
            width: 100%;
        }


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