/**
 * ANTALYA KORSAN TAKSİ - ANA JAVASCRIPT DOSYASI
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // ============================================
    // GLOBAL VARIABLES
    // ============================================
    const body = document.body;
    const header = document.querySelector('.site-header');
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mainNavigation = document.getElementById('main-navigation');
    const scrollToTopBtn = document.querySelector('.scroll-to-top');

    // ============================================
    // UTILITY FUNCTIONS
    // ============================================
    
    /**
     * Debounce function
     */
    function debounce(func, wait = 20, immediate = true) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    /**
     * Throttle function
     */
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    /**
     * Check if element is in viewport
     */
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    /**
     * Smooth scroll to element
     */
    function smoothScrollTo(target, duration = 1000) {
        const targetElement = typeof target === 'string' ? document.querySelector(target) : target;
        if (!targetElement) return;

        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition - 80; // 80px offset for header
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const run = ease(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        function ease(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animation);
    }

    // ============================================
    // HEADER SCROLL EFFECT
    // ============================================
    function handleHeaderScroll() {
        if (window.scrollY > 100) {
            header?.classList.add('scrolled');
        } else {
            header?.classList.remove('scrolled');
        }
    }

    // ============================================
    // MOBILE MENU TOGGLE
    // ============================================
    function initMobileMenu() {
        if (!mobileMenuToggle || !mobileMenu) return;

        // Ensure ARIA state
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        mobileMenu.setAttribute('aria-hidden', 'true');

        function openMenu() {
            mobileMenuToggle.classList.add('active');
            mobileMenu.classList.add('open');
            body.classList.add('menu-open', 'no-scroll');
            mobileMenuToggle.setAttribute('aria-expanded', 'true');
            mobileMenu.setAttribute('aria-hidden', 'false');
        }

        function closeMenu() {
            mobileMenuToggle.classList.remove('active');
            mobileMenu.classList.remove('open');
            body.classList.remove('menu-open', 'no-scroll');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            mobileMenu.setAttribute('aria-hidden', 'true');
        }

        function toggleMenu() {
            if (mobileMenu.classList.contains('open')) {
                closeMenu();
            } else {
                openMenu();
            }
        }

        // Toggle on button click
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMenu();
        });

        // Close when clicking any link inside mobile menu
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => closeMenu());
        });

        // Close when clicking outside (on document)
        document.addEventListener('click', (e) => {
            const clickedInsideMenu = mobileMenu.contains(e.target) || mobileMenuToggle.contains(e.target);
            if (!clickedInsideMenu && mobileMenu.classList.contains('open')) {
                closeMenu();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
                closeMenu();
            }
        });

        // Prevent interference from theme dropdown clicks
        const themeToggle = document.getElementById('theme-toggle');
        const themeDropdown = document.getElementById('theme-dropdown');
        if (themeToggle) {
            themeToggle.addEventListener('click', (e) => e.stopPropagation());
        }
        if (themeDropdown) {
            themeDropdown.addEventListener('click', (e) => e.stopPropagation());
        }
    }

    // ============================================
    // SCROLL TO TOP BUTTON
    // ============================================
    function initScrollToTop() {
        if (!scrollToTopBtn) return;

        // Show/hide button based on scroll position
        function toggleScrollToTop() {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        }

        window.addEventListener('scroll', throttle(toggleScrollToTop, 200));

        // Scroll to top on click
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ============================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ============================================
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Skip if href is just "#"
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    smoothScrollTo(target);
                    
                    // Update URL without jumping
                    if (history.pushState) {
                        history.pushState(null, null, href);
                    }
                }
            });
        });
    }

    // ============================================
    // LAZY LOADING IMAGES
    // ============================================
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('img.lazy');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.remove('lazy');
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback for browsers that don't support IntersectionObserver
            lazyImages.forEach(img => {
                img.src = img.dataset.src || img.src;
                img.classList.remove('lazy');
                img.classList.add('loaded');
            });
        }
    }

    // ============================================
    // ACTIVE NAVIGATION LINK
    // ============================================
    function updateActiveNavLink() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-menu a');
        
        let currentSection = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (window.scrollY >= (sectionTop - 200)) {
                currentSection = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${currentSection}`) {
                link.classList.add('active');
            }
        });
    }

    // ============================================
    // FORM VALIDATION
    // ============================================
    function initFormValidation() {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                let isValid = true;
                const inputs = form.querySelectorAll('input[required], textarea[required]');
                
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('error');
                        
                        // Remove error class on input
                        input.addEventListener('input', function() {
                            this.classList.remove('error');
                        }, { once: true });
                    }
                });
                
                if (isValid) {
                    // Submit form or handle with AJAX
                    console.log('Form is valid, submitting...');
                    form.submit();
                }
            });
        });
    }

    // ============================================
    // WHATSAPP WIDGET
    // ============================================
    function initWhatsAppWidget() {
        const whatsappButtons = document.querySelectorAll('[href*="wa.me"], [href*="whatsapp"]');
        
        whatsappButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Track WhatsApp click (for analytics)
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'whatsapp_click', {
                        'event_category': 'engagement',
                        'event_label': 'WhatsApp Button'
                    });
                }
            });
        });
    }

    // ============================================
    // ANIMATION ON SCROLL
    // ============================================
    function initScrollAnimations() {
        const animatedElements = document.querySelectorAll('[data-animate]');
        
        if ('IntersectionObserver' in window) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const animationType = element.dataset.animate || 'fadeInUp';
                        element.classList.add('animate-' + animationType);
                        animationObserver.unobserve(element);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            animatedElements.forEach(el => animationObserver.observe(el));
        }
    }

    // ============================================
    // PRELOADER
    // ============================================
    function hidePreloader() {
        const preloader = document.querySelector('.preloader');
        if (preloader) {
            setTimeout(() => {
                preloader.classList.add('fade-out');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }, 1000);
        }
    }

    // ============================================
    // THEME SWITCHER
    // ============================================
    function initThemeSwitcher() {
        // Header theme is handled in assets/js/theme.js (setupHeaderThemeButtons)
        // Keep compatibility for any .theme-btn within pages
        const themeButtons = document.querySelectorAll('.theme-btn');
        if (!themeButtons.length) return;

        const saved = (window.ThemeAPI && ThemeAPI.current && ThemeAPI.current()) || localStorage.getItem('theme') || 'corporate';
        document.body.setAttribute('data-theme', saved);

        themeButtons.forEach(btn => {
            if (btn.dataset.theme === saved) btn.classList.add('active');
            btn.addEventListener('click', function() {
                const theme = this.dataset.theme;
                themeButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                if (window.ThemeAPI && ThemeAPI.switch) {
                    ThemeAPI.switch(theme);
                } else {
                    document.body.setAttribute('data-theme', theme);
                    localStorage.setItem('theme', theme);
                }
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'theme_change', {
                        'event_category': 'engagement',
                        'event_label': theme
                    });
                }
            });
        });
    }

    // ============================================
    // PERFORMANCE OPTIMIZATION
    // ============================================
    function optimizePerformance() {
        // Defer non-critical CSS
        const deferredStyles = document.querySelectorAll('link[data-defer]');
        deferredStyles.forEach(link => {
            link.rel = 'stylesheet';
        });

        // Lazy load videos
        const videos = document.querySelectorAll('video[data-src]');
        videos.forEach(video => {
            video.src = video.dataset.src;
            video.load();
        });
    }

    // ============================================
    // CONSOLE BRANDING
    // ============================================
    function consoleBranding() {
        const styles = [
            'color: #FFD700',
            'background: #1A1A1A',
            'font-size: 20px',
            'font-weight: bold',
            'padding: 10px 20px',
            'border-radius: 5px'
        ].join(';');

        console.log('%c🚕 Antalya Korsan Taksi', styles);
        console.log('%cGeliştirici: Burak KAYA', 'color: #FF6B00; font-size: 14px;');
        console.log('%cWhatsApp: +905528975831', 'color: #25D366; font-size: 12px;');
    }

    // ============================================
    // ERROR HANDLING
    // ============================================
    function initErrorHandling() {
        window.addEventListener('error', function(e) {
            console.error('JavaScript Error:', e.message);
            // You can send errors to analytics or error tracking service
        });

        window.addEventListener('unhandledrejection', function(e) {
            console.error('Unhandled Promise Rejection:', e.reason);
        });
    }

    // ============================================
    // INITIALIZE ALL FUNCTIONS
    // ============================================
    function init() {
        // Console branding
        consoleBranding();

        // Error handling
        initErrorHandling();

        // Header scroll effect
        window.addEventListener('scroll', throttle(handleHeaderScroll, 100));
        handleHeaderScroll(); // Initial check

        // Mobile menu
        initMobileMenu();

        // Scroll to top button
        initScrollToTop();

        // Smooth scroll
        initSmoothScroll();

        // Lazy loading
        initLazyLoading();

        // Active nav link
        window.addEventListener('scroll', throttle(updateActiveNavLink, 200));

        // Form validation
        initFormValidation();

        // WhatsApp widget
        initWhatsAppWidget();

        // Scroll animations
        initScrollAnimations();

        // Theme switcher
        initThemeSwitcher();

        // Performance optimization
        optimizePerformance();

        // Hide preloader
        hidePreloader();

        // Log initialization
        console.log('%c✅ Site başarıyla yüklendi!', 'color: #28A745; font-weight: bold;');
    }

    // ============================================
    // DOM READY
    // ============================================
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // ============================================
    // WINDOW LOAD
    // ============================================
    window.addEventListener('load', function() {
        // Additional initialization after full page load
        console.log('%c🚀 Tüm kaynaklar yüklendi!', 'color: #17A2B8; font-weight: bold;');
    });

    // ============================================
    // EXPOSE PUBLIC API
    // ============================================
    window.AntalyaKorsanTaksi = {
        smoothScrollTo: smoothScrollTo,
        isInViewport: isInViewport,
        version: '1.0.0'
    };

})();
