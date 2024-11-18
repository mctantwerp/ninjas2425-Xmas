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
        <div class="input">
            <input type="text" placeholder="Type the letters here!" v-model="userInput">
            <i class="fa-regular fa-trash-can" @click="clearInput"></i>
        </div>
        <div class="action">
            <button>Submit
                <i class="fa-regular fa-gift"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            userInput: ''
        }
    },
    methods: {
        clearInput() {
            console.log('clear input');
            this.userInput = '';
        }
    }
}
</script>

<style lang="scss" scoped>
@import "/resources/sass/_variables.scss";

.rebus-wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    gap: 64px;
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