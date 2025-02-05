import { gsap } from "gsap";

window.addEventListener("load", () => {
    if (sessionStorage.getItem("loaderShown")) {
        document.getElementById("loader").remove();
        gsap.set("main", { autoAlpha: 1 });
        return;
    }

    gsap.set("main", { autoAlpha: 0 });

    const loaderTimeline = gsap.timeline({
        defaults: { ease: "power2.inOut" },
        onComplete: () => {
            document.getElementById("loader").remove();
            sessionStorage.setItem("loaderShown", true);
        },
    });

    loaderTimeline.fromTo("#loader-logo", {
        scale: 0.5,
        opacity: 0,
        rotation: -180,
    },
    {
        duration: 1,
        scale: 1,
        opacity: 1,
        rotation: 0,
    }).to("#loader-logo", {
        duration: 0.5,
        scale: 0.8,
        yoyo: true,
        repeat: 1,
    }).to("#loader", {
        duration: 0.8,
        opacity: 0,
        y: "-100%",
    }).fromTo("main", {
        autoAlpha: 0,
        y: 20,
    },
    {
        duration: 0.8,
        autoAlpha: 1,
        y: 0,
    },
    "-=0.4",
)});

export default createLoaderAnimation;