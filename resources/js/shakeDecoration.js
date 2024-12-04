import { gsap } from "gsap";

document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(".snow, .gingerman, .candy");
    const snow = document.querySelector(".snow");
    const gingerman = document.querySelector(".gingerman");
    const candy = document.querySelector(".candy");
    // Create a new Audio object
    const ornaments = new Audio('/sfx/ornaments.wav');
    const tinkling = new Audio('/sfx/tinkling.wav');
    const crunch = new Audio('/sfx/crunch.wav');
    var clicked = false;

    elements.forEach(element => {
        element.addEventListener("click", async () => {
            if (clicked) {
                return
            }
            clicked = true;
            if (element.className === "snow") {
                //init
                ornaments.volume = 1;
                ornaments.currentTime = 0;
                //play
                ornaments.play();
                //shake
                await triggerShake(element);
                fadeAudio(ornaments);
            }
            else if (element.className === "gingerman") {
                crunch.volume = 1;
                crunch.currentTime = 0;
                crunch.play();
                await triggerShake(element);
                fadeAudio(crunch);
            }
            else if (element.className === "candy") {
                tinkling.volume = 1;
                tinkling.currentTime = 0;
                tinkling.play();
                await triggerShake(element);
                fadeAudio(tinkling);
            }
            delay(250);
            clicked = false;
        });
    });

    const triggerShakeLoop = async () => {
        let randomNumber;

        //4000 = max and 2500 = min
        randomNumber = Math.floor(Math.random() * (4000 - 2500 + 1)) + 2500;
        await triggerShake(snow);
        await delay(randomNumber);

        //4500 = max and 3000 = min
        randomNumber = Math.floor(Math.random() * (4500 - 3000 + 1)) + 3000;
        await triggerShake(gingerman);
        await delay(randomNumber);

        //1250 = max and 600 = min
        randomNumber = Math.floor(Math.random() * (1250 - 600 + 1)) + 600;
        await triggerShake(snow);
        await delay(randomNumber);
        await triggerShake(candy);

        setTimeout(triggerShakeLoop, 5000);
    };

    triggerShakeLoop();
});

async function triggerShake(element) {
    await gsap.to(element, {
        duration: 0.15,
        x: 2,
        repeat: 15,
        yoyo: true,
        ease: "bounce.inOut",
    });
    gsap.to(element, {
        duration: 0.15,
        x: 0,
        repeat: 6,
        ease: "bounce.inOut",
    });
}

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function fadeAudio(audio) {
    for (let index = 100; index >= 0; index--) {
        audio.volume = index / 100;
        await delay(10);
    }
}