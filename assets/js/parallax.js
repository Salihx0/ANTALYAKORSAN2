/**
 * PARALLAX EFFECTS
 * Antalya Korsan Taksi - Gelişmiş Parallax Animasyonlar
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // Parallax ayarları
    const CONFIG = {
        enabled: true,
        smoothness: 0.1,
        maxDepth: 100,
        gyroEnabled: true,
        mouseEnabled: true
    };

    // Mouse pozisyonu
    let mouseX = 0;
    let mouseY = 0;
    let targetX = 0;
    let targetY = 0;

    // Gyro verileri
    let gyroX = 0;
    let gyroY = 0;

    // Parallax elementleri
    const parallaxElements = [];

    /**
     * Parallax element kaydet
     */
    function registerParallaxElement(element) {
        const depth = parseFloat(element.getAttribute('data-depth')) || 0.5;
        const direction = element.getAttribute('data-direction') || 'both'; // both, x, y
        const speed = parseFloat(element.getAttribute('data-speed')) || 1;
        
        parallaxElements.push({
            element,
            depth,
            direction,
            speed,
            originalX: 0,
            originalY: 0
        });
    }

    /**
     * Tüm parallax elementlerini bul
     */
    function findParallaxElements() {
        document.querySelectorAll('[data-parallax]').forEach(element => {
            registerParallaxElement(element);
        });

        console.log(`✅ Found ${parallaxElements.length} parallax elements`);
    }

    /**
     * Mouse parallax
     */
    function handleMouseMove(e) {
        if (!CONFIG.mouseEnabled) return;

        const centerX = window.innerWidth / 2;
        const centerY = window.innerHeight / 2;

        targetX = (e.clientX - centerX) / centerX;
        targetY = (e.clientY - centerY) / centerY;
    }

    /**
     * Gyro parallax
     */
    function handleDeviceOrientation(e) {
        if (!CONFIG.gyroEnabled) return;

        // Beta: front-to-back tilt (-180 to 180)
        // Gamma: left-to-right tilt (-90 to 90)
        gyroX = (e.gamma || 0) / 90; // -1 to 1
        gyroY = (e.beta || 0) / 180; // -1 to 1
    }

    /**
     * Parallax güncelle
     */
    function updateParallax() {
        if (!CONFIG.enabled) return;

        // Smooth interpolation
        mouseX += (targetX - mouseX) * CONFIG.smoothness;
        mouseY += (targetY - mouseY) * CONFIG.smoothness;

        // Her element için parallax uygula
        parallaxElements.forEach(item => {
            const { element, depth, direction, speed } = item;

            let moveX = 0;
            let moveY = 0;

            // Mouse parallax
            if (CONFIG.mouseEnabled) {
                if (direction === 'both' || direction === 'x') {
                    moveX += mouseX * depth * CONFIG.maxDepth * speed;
                }
                if (direction === 'both' || direction === 'y') {
                    moveY += mouseY * depth * CONFIG.maxDepth * speed;
                }
            }

            // Gyro parallax
            if (CONFIG.gyroEnabled) {
                if (direction === 'both' || direction === 'x') {
                    moveX += gyroX * depth * CONFIG.maxDepth * speed * 0.5;
                }
                if (direction === 'both' || direction === 'y') {
                    moveY += gyroY * depth * CONFIG.maxDepth * speed * 0.5;
                }
            }

            // Transform uygula
            element.style.transform = `translate3d(${moveX}px, ${moveY}px, 0)`;
        });

        requestAnimationFrame(updateParallax);
    }

    /**
     * Scroll parallax
     */
    function initScrollParallax() {
        const scrollElements = document.querySelectorAll('[data-scroll-parallax]');

        scrollElements.forEach(element => {
            const speed = parseFloat(element.getAttribute('data-scroll-speed')) || 0.5;
            const direction = element.getAttribute('data-scroll-direction') || 'up'; // up, down

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rect = element.getBoundingClientRect();
                const elementTop = rect.top + scrolled;
                const elementHeight = rect.height;
                const windowHeight = window.innerHeight;

                // Element görünür mü?
                if (scrolled + windowHeight > elementTop && scrolled < elementTop + elementHeight) {
                    const offset = (scrolled - elementTop + windowHeight) * speed;
                    const moveY = direction === 'down' ? offset : -offset;
                    
                    element.style.transform = `translate3d(0, ${moveY}px, 0)`;
                }
            });
        });
    }

    /**
     * Tilt effect
     */
    function initTiltEffect() {
        document.querySelectorAll('[data-tilt]').forEach(element => {
            const maxTilt = parseFloat(element.getAttribute('data-tilt-max')) || 15;
            const perspective = parseFloat(element.getAttribute('data-tilt-perspective')) || 1000;
            const scale = parseFloat(element.getAttribute('data-tilt-scale')) || 1.05;

            element.style.transformStyle = 'preserve-3d';
            element.style.perspective = perspective + 'px';

            element.addEventListener('mousemove', (e) => {
                const rect = element.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = ((y - centerY) / centerY) * maxTilt;
                const rotateY = ((centerX - x) / centerX) * maxTilt;

                element.style.transform = `
                    perspective(${perspective}px)
                    rotateX(${rotateX}deg)
                    rotateY(${rotateY}deg)
                    scale3d(${scale}, ${scale}, ${scale})
                `;
            });

            element.addEventListener('mouseleave', () => {
                element.style.transform = `
                    perspective(${perspective}px)
                    rotateX(0deg)
                    rotateY(0deg)
                    scale3d(1, 1, 1)
                `;
            });
        });
    }

    /**
     * Depth layers
     */
    function initDepthLayers() {
        const container = document.querySelector('[data-depth-container]');
        if (!container) return;

        const layers = container.querySelectorAll('[data-depth-layer]');

        container.addEventListener('mousemove', (e) => {
            const rect = container.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;

            layers.forEach(layer => {
                const depth = parseFloat(layer.getAttribute('data-depth-layer')) || 1;
                const moveX = x * depth * 50;
                const moveY = y * depth * 50;

                layer.style.transform = `translate3d(${moveX}px, ${moveY}px, 0)`;
            });
        });

        container.addEventListener('mouseleave', () => {
            layers.forEach(layer => {
                layer.style.transform = 'translate3d(0, 0, 0)';
            });
        });
    }

    /**
     * Parallax background
     */
    function initParallaxBackground() {
        document.querySelectorAll('[data-parallax-bg]').forEach(element => {
            const speed = parseFloat(element.getAttribute('data-parallax-speed')) || 0.5;

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const offset = scrolled * speed;
                
                element.style.backgroundPositionY = offset + 'px';
            });
        });
    }

    /**
     * Infinite scroll parallax
     */
    function initInfiniteParallax() {
        document.querySelectorAll('[data-infinite-parallax]').forEach(element => {
            const speed = parseFloat(element.getAttribute('data-infinite-speed')) || 1;
            let position = 0;

            function animate() {
                position += speed;
                element.style.transform = `translateX(${position}px)`;

                // Reset position
                if (Math.abs(position) > element.offsetWidth) {
                    position = 0;
                }

                requestAnimationFrame(animate);
            }

            animate();
        });
    }

    /**
     * Sticky parallax
     */
    function initStickyParallax() {
        document.querySelectorAll('[data-sticky-parallax]').forEach(element => {
            const container = element.parentElement;
            const speed = parseFloat(element.getAttribute('data-sticky-speed')) || 0.5;

            window.addEventListener('scroll', () => {
                const containerRect = container.getBoundingClientRect();
                const containerTop = containerRect.top;
                const containerHeight = containerRect.height;

                if (containerTop < 0 && containerTop > -containerHeight) {
                    const offset = Math.abs(containerTop) * speed;
                    element.style.transform = `translateY(${offset}px)`;
                }
            });
        });
    }

    /**
     * Reveal parallax
     */
    function initRevealParallax() {
        document.querySelectorAll('[data-reveal-parallax]').forEach(element => {
            const direction = element.getAttribute('data-reveal-direction') || 'up';
            const distance = parseFloat(element.getAttribute('data-reveal-distance')) || 100;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const progress = entry.intersectionRatio;
                        let moveY = 0;

                        switch(direction) {
                            case 'up':
                                moveY = distance * (1 - progress);
                                break;
                            case 'down':
                                moveY = -distance * (1 - progress);
                                break;
                        }

                        element.style.transform = `translateY(${moveY}px)`;
                        element.style.opacity = progress;
                    }
                });
            }, {
                threshold: Array.from({ length: 101 }, (_, i) => i / 100)
            });

            observer.observe(element);
        });
    }

    /**
     * Gyro izni iste
     */
    function requestGyroPermission() {
        if (typeof DeviceOrientationEvent !== 'undefined' && 
            typeof DeviceOrientationEvent.requestPermission === 'function') {
            DeviceOrientationEvent.requestPermission()
                .then(permissionState => {
                    if (permissionState === 'granted') {
                        window.addEventListener('deviceorientation', handleDeviceOrientation);
                        console.log('✅ Gyro permission granted');
                    }
                })
                .catch(console.error);
        } else {
            // iOS 13+ olmayan cihazlar için
            window.addEventListener('deviceorientation', handleDeviceOrientation);
        }
    }

    /**
     * Performance optimization
     */
    function optimizePerformance() {
        // Reduced motion kontrolü
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            CONFIG.enabled = false;
            console.log('⚠️ Parallax disabled (reduced motion preference)');
            return;
        }

        // Mobil cihazlarda mouse parallax'ı kapat
        if (window.innerWidth <= 768) {
            CONFIG.mouseEnabled = false;
        }

        // Düşük performanslı cihazlarda gyro'yu kapat
        if (navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4) {
            CONFIG.gyroEnabled = false;
        }
    }

    /**
     * Initialize
     */
    function init() {
        // Performance optimization
        optimizePerformance();

        if (!CONFIG.enabled) return;

        // Parallax elementlerini bul
        findParallaxElements();

        // Mouse events
        if (CONFIG.mouseEnabled) {
            document.addEventListener('mousemove', handleMouseMove);
        }

        // Gyro events
        if (CONFIG.gyroEnabled) {
            requestGyroPermission();
        }

        // Diğer parallax efektleri
        initScrollParallax();
        initTiltEffect();
        initDepthLayers();
        initParallaxBackground();
        initInfiniteParallax();
        initStickyParallax();
        initRevealParallax();

        // Animasyon döngüsünü başlat
        updateParallax();

        console.log('✅ Parallax Effects initialized');
    }

    /**
     * Public API
     */
    window.ParallaxAPI = {
        enable: () => {
            CONFIG.enabled = true;
            updateParallax();
        },
        disable: () => {
            CONFIG.enabled = false;
        },
        toggle: () => {
            CONFIG.enabled = !CONFIG.enabled;
            if (CONFIG.enabled) updateParallax();
        },
        setSmoothing: (value) => {
            CONFIG.smoothness = Math.max(0, Math.min(1, value));
        },
        refresh: () => {
            parallaxElements.length = 0;
            findParallaxElements();
        }
    };

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Resize handler
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            optimizePerformance();
            ParallaxAPI.refresh();
        }, 250);
    });

})();

/**
 * Kullanım Örnekleri:
 * 
 * 1. Basit parallax:
 *    <div data-parallax data-depth="0.5">Content</div>
 * 
 * 2. Yatay parallax:
 *    <div data-parallax data-depth="0.3" data-direction="x">Content</div>
 * 
 * 3. Scroll parallax:
 *    <div data-scroll-parallax data-scroll-speed="0.5">Content</div>
 * 
 * 4. Tilt effect:
 *    <div data-tilt data-tilt-max="20">Content</div>
 * 
 * 5. Depth layers:
 *    <div data-depth-container>
 *      <div data-depth-layer="1">Layer 1</div>
 *      <div data-depth-layer="2">Layer 2</div>
 *    </div>
 * 
 * 6. Parallax background:
 *    <div data-parallax-bg data-parallax-speed="0.5" 
 *         style="background-image: url(...)">
 *    </div>
 * 
 * 7. Infinite parallax:
 *    <div data-infinite-parallax data-infinite-speed="1">Content</div>
 * 
 * 8. Sticky parallax:
 *    <div>
 *      <div data-sticky-parallax data-sticky-speed="0.5">Content</div>
 *    </div>
 * 
 * 9. Reveal parallax:
 *    <div data-reveal-parallax data-reveal-direction="up">Content</div>
 * 
 * JavaScript API:
 * - ParallaxAPI.enable()
 * - ParallaxAPI.disable()
 * - ParallaxAPI.toggle()
 * - ParallaxAPI.setSmoothing(0.2)
 * - ParallaxAPI.refresh()
 */
