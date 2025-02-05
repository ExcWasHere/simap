import { gsap } from "gsap";

class Carousel {
    constructor() {
        this.currentIndex = 0;
        this.images = document.querySelectorAll(".carousel-image");
        this.indicators = document.querySelectorAll(".carousel-indicator");
        this.totalSlides = this.images.length;
        this.interval = null;
        this.duration = 0.5;
        this.autoPlayDelay = 5;

        if (this.totalSlides === 0) return;

        this.init();
    }

    init() {
        gsap.set(this.images, { opacity: 0 });
        gsap.set(this.images[0], { opacity: 1 });

        this.indicators.forEach((indicator, index) => {
            indicator.addEventListener("click", () => this.goToSlide(index));
        });

        this.startAutoPlay();
    }

    goToSlide(index) {
        if (index === this.currentIndex) return;

        this.indicators[this.currentIndex].classList.remove("bg-white");
        this.indicators[index].classList.add("bg-white");

        gsap.to(this.images[this.currentIndex], {
            opacity: 0,
            duration: this.duration,
            ease: "power2.inOut",
        });

        gsap.to(this.images[index], {
            opacity: 1,
            duration: this.duration,
            ease: "power2.inOut",
        });

        this.currentIndex = index;
        this.resetAutoPlay();
    }

    nextSlide() {
        const nextIndex = (this.currentIndex + 1) % this.totalSlides;
        this.goToSlide(nextIndex);
    }

    startAutoPlay() {
        this.interval = setInterval(
            () => this.nextSlide(),
            this.autoPlayDelay * 1000,
        );
    }

    resetAutoPlay() {
        clearInterval(this.interval);
        this.startAutoPlay();
    }

    destroy() {
        clearInterval(this.interval);
        this.indicators.forEach((indicator) => {
            indicator.removeEventListener("click", () => this.goToSlide(index));
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const carousel = new Carousel();
    window.addEventListener("unload", () => carousel.destroy());
});

export default Carousel;