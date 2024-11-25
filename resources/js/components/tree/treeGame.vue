<template>
    <transition name="fade-with-slide" mode="out-in">
        <div class="image-container" ref="tree" v-if="!lettersVisible" @click="handleFalseClick">
            <img src="../assets/tree-clear.png"
                alt="search game background image with many icons like presents and others" class="image" />
            <div class="overlay-box first" @click="revealLetters">
                <span class="tree-game-letter"></span>
            </div>
            <div class="overlay-box second" @click="revealLetters">
                <span class="tree-game-letter"></span>
            </div>
            <div class="overlay-box third" @click="revealLetters">
                <span class="tree-game-letter"></span>
            </div>
            <div class="overlay-box fourth" @click="revealLetters">
                <span class="tree-game-letter"></span>
            </div>
        </div>
        <div class="image-container" ref="shakeElement" v-else>
            <img src="../assets/tree-filled.png"
                alt="search game background image with many icons like presents and others" class="image" />
            <div class="input" ref="inputField">
                <input type="text" :placeholder="inputPlaceholder" v-model="userInput">
                <i class="fa-regular fa-trash-can" @click="clearInput"></i>
            </div>
            <div class="action">
                <button @click="checkWord">Submit
                    <i class="fa-regular fa-gift"></i>
                </button>
            </div>
        </div>
    </transition>
</template>

<script>
import { gsap } from "gsap";
import axios from "axios";
export default {
    data() {
        return {
            lettersVisible: false,
            userInput: '',
            inputPlaceholder: 'Type the letters here!',
        }
    },
    methods: {
        correct() {
            this.$bus.emit('correct');
        },
        revealLetters() {
            this.lettersVisible = true;
        },
        async triggerShakeDiagonal(refName) {
            //animation
            await gsap.to(this.$refs[refName], {
                duration: 0.1,
                x: 6,
                y: 6,
                repeat: 4,
                yoyo: true,
                ease: "power2.inOut",
            });
            gsap.to(this.$refs[refName], {
                duration: 0.1,
                x: 0,
                y: 0,
                ease: "power2.inOut",
            });
        },
        async triggerHorizontalShake(refName) {
            await gsap.to(this.$refs[refName], {
                duration: 0.1,
                x: 3,
                repeat: 4,
                yoyo: true,
                ease: "power2.inOut",
            });
            gsap.to(this.$refs[refName], {
                duration: 0.1,
                x: 0,
                ease: "power2.inOut",
            });
        },
        clearInput() {
            console.log('clear input');
            this.userInput = '';
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
        },
        async checkWord() {
            try {
                if (this.userInput === '') {
                    this.triggerHorizontalShake('inputField');
                    return;

                }
                const response = await axios.post('/api/checkTree', {
                    word: this.userInput,
                });

                const { result } = response.data;

                if (result) {
                    this.correct();
                } else {
                    this.triggerHorizontalShake('inputField');
                    this.generateRandomPlaceholder();
                }
            } catch (error) {
                console.error('Error sending data:', error);
                this.responseMessage = 'Error submitting the word.';
            }
            this.clearInput();
        },
        handleFalseClick(event) {
            //if target is the tree itself on the wrong spot --> shake tree
            if (event.target.classList.contains('image')) {
                this.triggerShakeDiagonal('tree');
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.image-container {
    position: relative;
    display: inline-block;
    width: 100%;
    max-width: 500px;
}

.image {
    display: block;
    width: 75%;
    margin: 0 auto;
    padding: 16px;
}

.overlay-box {
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    position: absolute;
    width: 40px;
    height: 40px;
    z-index: 10;

    span {
        color: white;
    }
}

.first {
    top: 30%;
    right: 45%;
}

.second {
    bottom: 40%;
    left: 31.75%;
}

.third {
    bottom: 40%;
    right: 33.5%;
}

.fourth {
    bottom: 25%;
    left: 43.5%;
}

@media (min-width:420px) {
    .first {
        top: 32%;
        right: 46%;
    }

    .second {
        bottom: 40%;
        left: 34%;
    }

    .third {
        bottom: 40%;
        right: 35%;
    }

    .fourth {
        bottom: 25%;
        left: 45.5%;
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
</style>