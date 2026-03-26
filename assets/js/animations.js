/**
 * ADVANCED ANIMATIONS - GSAP & ScrollTrigger
 * Antalya Korsan Taksi - Premium Animasyonlar
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // GSAP kontrolü
    if (typeof gsap === 'undefined') {
        console.warn('GSAP not loaded. Loading from CDN...');
        loadGSAP();
        return;
    }

    /**
     * GSAP yükle
     */
    function loadGSAP() {
        const script1 = document.createElement('script');
        script1.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js';
        script1.onload = () => {
            const script2 = document.createElement('script');
            script2.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js';
            script2.onload = init;
            document.head.appendChild(script2);
        };
        document.head.appendChild(script1);
    }

    /**
     * Initialize
     */
    function init() {
        // ScrollTrigger kaydet
        gsap.registerPlugin(ScrollTrigger);

        // Animasyonları başlat
        initHeroAnimations();
        initScrollAnimations();
        initServiceCardAnimations();
        initCounterAnimations();
        initTextAnimations();
        initImageAnimations();
        initButtonAnimations();
        initParallaxAnimations();
        initMorphingAnimations();
        initStaggerAnimations();

        console.log('✅ GSAP Animations initialized');
    }

    /**
     * Hero animasyonları
     */
    function initHeroAnimations() {
        const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        tl.from('.hero-title-main', {
            duration: 1,
            y: 100,
            opacity: 0,
            scale: 0.8,
            rotationX: -90
        })
        .from('.hero-title-sub', {
            duration: 0.8,
            y: 50,
            opacity: 0
        }, '-=0.5')
        .from('.hero-description', {
            duration: 0.8,
            y: 30,
            opacity: 0
        }, '-=0.4')
        .from('.hero-buttons .btn', {
            duration: 0.6,
            y: 30,
            opacity: 0,
            stagger: 0.2
        }, '-=0.4')
        .from('.hero-feature', {
            duration: 0.5,
            y: 20,
            opacity: 0,
            stagger: 0.1
        }, '-=0.3');

        // Hero background parallax
        gsap.to('.hero-background', {
            yPercent: 30,
            ease: 'none',
            scrollTrigger: {
                trigger: '.hero-section',
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });
    }

    /**
     * Scroll animasyonları
     */
    function initScrollAnimations() {
        // Fade in up
        gsap.utils.toArray('.scroll-fade-in').forEach(element => {
            gsap.from(element, {
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    end: 'top 20%',
                    toggleActions: 'play none none reverse'
                },
                y: 50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
        });

        // Slide from left
        gsap.utils.toArray('.scroll-slide-left').forEach(element => {
            gsap.from(element, {
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                },
                x: -100,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
        });

        // Slide from right
        gsap.utils.toArray('.scroll-slide-right').forEach(element => {
            gsap.from(element, {
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                },
                x: 100,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
        });

        // Zoom in
        gsap.utils.toArray('.scroll-zoom-in').forEach(element => {
            gsap.from(element, {
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                },
                scale: 0.8,
                opacity: 0,
                duration: 1,
                ease: 'back.out(1.7)'
            });
        });
    }

    /**
     * Service card animasyonları
     */
    function initServiceCardAnimations() {
        gsap.utils.toArray('.service-card').forEach((card, index) => {
            // Hover animasyonu
            card.addEventListener('mouseenter', () => {
                gsap.to(card, {
                    y: -15,
                    scale: 1.05,
                    duration: 0.3,
                    ease: 'power2.out'
                });

                gsap.to(card.querySelector('.service-icon'), {
                    rotation: 360,
                    scale: 1.2,
                    duration: 0.6,
                    ease: 'back.out(1.7)'
                });
            });

            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    y: 0,
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });

                gsap.to(card.querySelector('.service-icon'), {
                    rotation: 0,
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            // Scroll animasyonu
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                },
                y: 60,
                opacity: 0,
                rotation: -5,
                duration: 0.8,
                delay: index * 0.1,
                ease: 'power3.out'
            });
        });
    }

    /**
     * Counter animasyonları
     */
    function initCounterAnimations() {
        gsap.utils.toArray('.counter').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = parseFloat(counter.getAttribute('data-duration')) || 2;

            ScrollTrigger.create({
                trigger: counter,
                start: 'top 80%',
                onEnter: () => {
                    gsap.to(counter, {
                        innerText: target,
                        duration: duration,
                        snap: { innerText: 1 },
                        ease: 'power1.out',
                        onUpdate: function() {
                            counter.innerText = Math.ceil(this.targets()[0].innerText);
                        }
                    });
                }
            });
        });
    }

    /**
     * Text animasyonları
     */
    function initTextAnimations() {
        // Split text animasyonu
        gsap.utils.toArray('.split-text').forEach(element => {
            const text = element.textContent;
            element.innerHTML = text.split('').map(char => 
                `<span class="char">${char === ' ' ? '&nbsp;' : char}</span>`
            ).join('');

            gsap.from(element.querySelectorAll('.char'), {
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%'
                },
                opacity: 0,
                y: 50,
                rotationX: -90,
                stagger: 0.02,
                duration: 0.8,
                ease: 'back.out(1.7)'
            });
        });

        // Typing effect
        gsap.utils.toArray('.typing-text').forEach(element => {
            const text = element.textContent;
            element.textContent = '';

            ScrollTrigger.create({
                trigger: element,
                start: 'top 80%',
                onEnter: () => {
                    let i = 0;
                    const interval = setInterval(() => {
                        if (i < text.length) {
                            element.textContent += text.charAt(i);
                            i++;
                        } else {
                            clearInterval(interval);
                        }
                    }, 50);
                }
            });
        });
    }

    /**
     * Image animasyonları
     */
    function initImageAnimations() {
        // Reveal animasyonu
        gsap.utils.toArray('.image-reveal').forEach(container => {
            const image = container.querySelector('img');
            
            gsap.set(container, { overflow: 'hidden' });
            
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: container,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });

            tl.from(container, {
                clipPath: 'inset(0 100% 0 0)',
                duration: 1,
                ease: 'power3.out'
            })
            .from(image, {
                scale: 1.3,
                duration: 1,
                ease: 'power3.out'
            }, 0);
        });

        // Ken Burns effect
        gsap.utils.toArray('.ken-burns').forEach(image => {
            gsap.to(image, {
                scale: 1.2,
                duration: 10,
                ease: 'none',
                repeat: -1,
                yoyo: true
            });
        });
    }

    /**
     * Button animasyonları
     */
    function initButtonAnimations() {
        gsap.utils.toArray('.btn-animate').forEach(button => {
            button.addEventListener('mouseenter', () => {
                gsap.to(button, {
                    scale: 1.1,
                    duration: 0.3,
                    ease: 'back.out(1.7)'
                });
            });

            button.addEventListener('mouseleave', () => {
                gsap.to(button, {
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            button.addEventListener('click', () => {
                gsap.to(button, {
                    scale: 0.95,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
            });
        });
    }

    /**
     * Parallax animasyonları
     */
    function initParallaxAnimations() {
        gsap.utils.toArray('.parallax-slow').forEach(element => {
            gsap.to(element, {
                yPercent: -30,
                ease: 'none',
                scrollTrigger: {
                    trigger: element,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });
        });

        gsap.utils.toArray('.parallax-fast').forEach(element => {
            gsap.to(element, {
                yPercent: -60,
                ease: 'none',
                scrollTrigger: {
                    trigger: element,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });
        });
    }

    /**
     * Morphing animasyonları
     */
    function initMorphingAnimations() {
        gsap.utils.toArray('.morph-shape').forEach(shape => {
            gsap.to(shape, {
                borderRadius: '60% 40% 30% 70% / 60% 30% 70% 40%',
                duration: 3,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut'
            });
        });
    }

    /**
     * Stagger animasyonları
     */
    function initStaggerAnimations() {
        gsap.utils.toArray('.stagger-container').forEach(container => {
            const items = container.querySelectorAll('.stagger-item');
            
            gsap.from(items, {
                scrollTrigger: {
                    trigger: container,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                },
                y: 50,
                opacity: 0,
                stagger: 0.1,
                duration: 0.8,
                ease: 'power3.out'
            });
        });
    }

    /**
     * Scroll progress indicator
     */
    function initScrollProgress() {
        gsap.to('.scroll-progress', {
            width: '100%',
            ease: 'none',
            scrollTrigger: {
                trigger: 'body',
                start: 'top top',
                end: 'bottom bottom',
                scrub: 0.3
            }
        });
    }

    /**
     * Magnetic buttons
     */
    function initMagneticButtons() {
        gsap.utils.toArray('.magnetic').forEach(button => {
            button.addEventListener('mousemove', (e) => {
                const rect = button.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;

                gsap.to(button, {
                    x: x * 0.3,
                    y: y * 0.3,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            button.addEventListener('mouseleave', () => {
                gsap.to(button, {
                    x: 0,
                    y: 0,
                    duration: 0.5,
                    ease: 'elastic.out(1, 0.3)'
                });
            });
        });
    }

    /**
     * Page transitions
     */
    function initPageTransitions() {
        // Sayfa yüklendiğinde
        gsap.from('body', {
            opacity: 0,
            duration: 0.5,
            ease: 'power2.out'
        });

        // Link tıklamalarında
        document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
            link.addEventListener('click', (e) => {
                if (link.hostname === window.location.hostname) {
                    e.preventDefault();
                    const href = link.href;

                    gsap.to('body', {
                        opacity: 0,
                        duration: 0.3,
                        ease: 'power2.in',
                        onComplete: () => {
                            window.location.href = href;
                        }
                    });
                }
            });
        });
    }

    /**
     * Public API
     */
    window.AnimationsAPI = {
        animateElement: (element, options) => {
            return gsap.to(element, options);
        },
        createTimeline: (options) => {
            return gsap.timeline(options);
        },
        scrollTo: (target) => {
            gsap.to(window, {
                scrollTo: target,
                duration: 1,
                ease: 'power3.inOut'
            });
        },
        refresh: () => {
            ScrollTrigger.refresh();
        }
    };

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Scroll progress
    initScrollProgress();
    
    // Magnetic buttons
    initMagneticButtons();
    
    // Page transitions
    initPageTransitions();

})();

/**
 * Kullanım Örnekleri:
 * 
 * 1. Element animasyonu:
 *    AnimationsAPI.animateElement('.my-element', { x: 100, duration: 1 });
 * 
 * 2. Timeline oluştur:
 *    const tl = AnimationsAPI.createTimeline();
 *    tl.to('.el1', { x: 100 }).to('.el2', { y: 100 });
 * 
 * 3. Scroll to:
 *    AnimationsAPI.scrollTo('#section');
 * 
 * 4. ScrollTrigger refresh:
 *    AnimationsAPI.refresh();
 * 
 * HTML Class'ları:
 * - .scroll-fade-in: Fade in animasyonu
 * - .scroll-slide-left: Soldan kayma
 * - .scroll-slide-right: Sağdan kayma
 * - .scroll-zoom-in: Zoom in
 * - .parallax-slow: Yavaş parallax
 * - .parallax-fast: Hızlı parallax
 * - .magnetic: Magnetic efekt
 * - .split-text: Text split animasyonu
 * - .typing-text: Typing efekti
 * - .image-reveal: Image reveal
 * - .ken-burns: Ken Burns efekti
 * - .morph-shape: Morphing animasyon
 * - .stagger-container: Stagger container
 * - .stagger-item: Stagger item
 */
