import { gsap } from "gsap";

document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(".snow, .gingerman, .candy");
    const snow = document.querySelector(".snow");
    const gingerman = document.querySelector(".gingerman");
    const candy = document.querySelector(".candy");

    elements.forEach(element => {
        element.addEventListener("click", async () => {
            await triggerShake(element);
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
        x: 3,
        repeat: 4,
        yoyo: true,
        ease: "bounce.inOut",
    });
    await gsap.to(element, {
        duration: 0.15,
        x: 0,
        ease: "bounce.inOut",
    });
}

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


