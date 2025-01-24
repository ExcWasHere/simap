import { gsap } from 'gsap';

const createLoaderAnimation = () => {
    if (sessionStorage.getItem('loaderShown')) {
        const loader = document.getElementById('loader');
        if (loader) loader.remove();
        gsap.set('main', { autoAlpha: 1 });
        return;
    }

    gsap.set('main', { autoAlpha: 0 });
    
    const loaderTimeline = gsap.timeline({
        defaults: {
            ease: 'power2.inOut'
        },
        onComplete: () => {
            const loader = document.getElementById('loader');
            if (loader) loader.remove();
            sessionStorage.setItem('loaderShown', 'true');
        }
    });

    loaderTimeline
        .fromTo('#loaderLogo', {
            scale: 0.5,
            opacity: 0,
            rotation: -180
        }, {
            duration: 1,
            scale: 1,
            opacity: 1,
            rotation: 0
        })
        .to('#loaderLogo', {
            duration: 0.5,
            scale: 0.8,
            yoyo: true,
            repeat: 1
        })
        .to('#loader', {
            duration: 0.8,
            opacity: 0,
            y: '-100%'
        })
        .fromTo('main', {
            autoAlpha: 0,
            y: 20
        }, {
            duration: 0.8,
            autoAlpha: 1,
            y: 0
        }, '-=0.4');
};

document.addEventListener('DOMContentLoaded', () => {
    gsap.to('#loaderLogo', {
        duration: 1,
        scale: 1.2,
        yoyo: true,
        repeat: -1,
        ease: 'power1.inOut'
    });

    window.addEventListener('load', () => {
        gsap.to('#loader', {
            duration: 0.5,
            opacity: 0,
            onComplete: () => {
                document.getElementById('loader').style.display = 'none';
            }
        });
    });
});

export default createLoaderAnimation; 