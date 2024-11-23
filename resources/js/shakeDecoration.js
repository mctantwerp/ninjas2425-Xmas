import { gsap } from "gsap";

document.addEventListener("DOMContentLoaded", () => {
    // Select elements
    const elements = document.querySelectorAll(".snow, .gingerman, .candy");

    // Add click event listeners
    elements.forEach(element => {
        element.addEventListener("click", async () => {
            await triggerShake(element);
        });
    });
});


async function triggerShake(element) {
    // Use GSAP to animate the shake
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