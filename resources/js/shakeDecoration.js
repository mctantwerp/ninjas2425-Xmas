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
        await triggerShake(snow);
        await delay(2500);
        await triggerShake(gingerman);
        await delay(3250);
        await triggerShake(snow);
        await delay(750);
        await triggerShake(candy);

        setTimeout(triggerShakeLoop, 2500); //repeat every 7 seconds
    };

    //start loop
    triggerShakeLoop();
});

async function triggerShake(element) {
    await gsap.to(element, {
        duration: 0.1,
        x: 3,
        repeat: 4,
        yoyo: true,
        ease: "power2.inOut",
    });
    gsap.to(element, {
        duration: 0.1,
        x: 0,
        ease: "power2.inOut",
    });
}

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

