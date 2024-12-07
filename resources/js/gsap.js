import gsap from 'gsap';
document.addEventListener('DOMContentLoaded', () => {
    gsap.from(".content", {
        opacity: 0,
        y: 50,
        duration: 1.5,
        ease: "power3.out",
        onComplete: () => {
            gsap.set(".content", { clearProps: "all" });
        }
    })
});