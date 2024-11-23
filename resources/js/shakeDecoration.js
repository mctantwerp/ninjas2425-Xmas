import { gsap } from "gsap";

document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(".snow, .gingerman, .candy");
    elements.forEach(element => {
        element.addEventListener("click", async () => {
            await triggerShake(element);
        });
    });
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