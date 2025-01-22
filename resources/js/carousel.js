import { gsap } from 'gsap';

const initCarousel = () => {
    const items = document.querySelectorAll('.carousel-item');
    const dots = document.querySelectorAll('.carousel-dot');
    let currentIndex = 0;
    
    gsap.set(items[0], { opacity: 1 });
    dots[0].classList.add('opacity-100');
    
    const goToSlide = (index) => {
        gsap.to(items[currentIndex], {
            opacity: 0,
            duration: 1,
            ease: 'power2.inOut'
        });
        dots[currentIndex].classList.remove('opacity-100');
        
        gsap.to(items[index], {
            opacity: 1,
            duration: 1,
            ease: 'power2.inOut'
        });
        dots[index].classList.add('opacity-100');
        
        currentIndex = index;
    };
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => goToSlide(index));
    });
    
    const autoPlay = () => {
        const nextIndex = (currentIndex + 1) % items.length;
        goToSlide(nextIndex);
    };
    
    const interval = setInterval(autoPlay, 3000);
    
    const carousel = document.querySelector('.carousel');
    carousel.addEventListener('mouseenter', () => clearInterval(interval));
};

document.addEventListener('DOMContentLoaded', initCarousel); 