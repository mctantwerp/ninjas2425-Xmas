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
    });
    //check if cookie comply exists --> because it wont exist if user has already given consent
    if (document.querySelector('.cookie-comply')) {
        gsap.from('.cookie-comply', {
            opacity: 0,
            duration: 1.5,
            // y: -50,
            x: -200,
            ease: "power3.out",
            onComplete: () => {
                gsap.set('.cookie-comply', { clearProps: "all" });
            }
        });
    }
});
