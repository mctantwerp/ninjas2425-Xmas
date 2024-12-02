<template>
    <transition name="fade-with-slide" mode="out-in">
        <div class="image-container" ref="tree" v-if="!lettersVisible" @click="handleFalseClick">
            <img src="../assets/tree-clear.png"
                alt="image of a christmas tree with many ornaments in two different colors." class="image" />
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
            <teleport to=".game-container">
                <hint-popup>
                    <template v-slot:bottom-text>
                        To reveal a letter, press on one of the balls in the tree.
                    </template>
                </hint-popup>
            </teleport>
        </div>
        <div class="image-container" ref="shakeElement" v-else>
            <img src="../assets/tree-filled.png"
                alt="image of a christmas tree with the ornaments content revealing 4 letters: F, O, R, M"
                class="image" />
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
    display: inline-block;
    width: 100%;
    max-width: 500px;
    position: relative;
}

.image {
    display: block;
    width: 75%;
    margin: 0 auto;
}

.overlay-box {
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    position: absolute;
    width: 30px;
    height: 30px;
    z-index: 10;

    span {
        color: white;
    }
}

.first {
    top: 33%;
    right: 47.5%;
}

.second {
    bottom: 39%;
    left: 35%;
}

.third {
    bottom: 39%;
    right: 36%;
}

.fourth {
    bottom: 25%;
    left: 46.5%;
}

@media (max-width:420px) {
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

@media (max-width:370px) {
    .first {
        top: 31%;
        right: 46%;
    }

    .second {
        bottom: 38%;
        left: 33%;
    }

    .third {
        bottom: 38%;
        right: 34%;
    }

    .fourth {
        bottom: 23%;
        left: 44%;
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