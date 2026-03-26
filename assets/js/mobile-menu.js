/**
 * MOBİL MENÜ - YENİDEN YAZILDI
 * Antalya Korsan Taksi - Mobil Menü Yönetimi
 * 
 * @package AntalyaKorsanTaksi
 * @version 2.0
 * @date 2025
 */

(function() {
    'use strict';
    
    // DOM Elementleri
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    const body = document.body;
    
    // Menü durumu
    let isMenuOpen = false;
    
    /**
     * Menüyü Aç
     */
    function openMenu() {
        if (isMenuOpen) return;
        
        isMenuOpen = true;
        
        // Class ekle
        mobileMenu.classList.add('open');
        mobileMenuToggle.classList.add('active');
        body.classList.add('menu-open');
        
        // ARIA attributes
        mobileMenuToggle.setAttribute('aria-expanded', 'true');
        mobileMenu.setAttribute('aria-hidden', 'false');
        
        // Focus trap - ilk linke focus
        setTimeout(() => {
            const firstLink = mobileMenu.querySelector('.mobile-nav-link');
            if (firstLink) {
                firstLink.focus();
            }
        }, 100);
        
        // Scroll pozisyonunu kaydet
        body.style.top = `-${window.scrollY}px`;
        
        console.log('✅ Mobil menü açıldı');
    }
    
    /**
     * Menüyü Kapat
     */
    function closeMenu() {
        if (!isMenuOpen) return;
        
        isMenuOpen = false;
        
        // Class kaldır
        mobileMenu.classList.remove('open');
        mobileMenuToggle.classList.remove('active');
        body.classList.remove('menu-open');
        
        // ARIA attributes
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        mobileMenu.setAttribute('aria-hidden', 'true');
        
        // Scroll pozisyonunu geri yükle
        const scrollY = body.style.top;
        body.style.top = '';
        window.scrollTo(0, parseInt(scrollY || '0') * -1);
        
        // Focus'u toggle button'a geri ver
        mobileMenuToggle.focus();
        
        console.log('✅ Mobil menü kapatıldı');
    }
    
    /**
     * Menüyü Toggle Et
     */
    function toggleMenu() {
        if (isMenuOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    }
    
    /**
     * Event Listeners
     */
    function initEventListeners() {
        // Toggle button click
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMenu();
            });
        }
        
        // Nav link click - menüyü kapat
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeMenu();
            });
        });
        
        // Overlay click - menüyü kapat
        if (mobileMenu) {
            mobileMenu.addEventListener('click', function(e) {
                // Sadece overlay'e tıklanırsa kapat (içeriğe değil)
                if (e.target === mobileMenu) {
                    closeMenu();
                }
            });
        }
        
        // ESC tuşu - menüyü kapat
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isMenuOpen) {
                closeMenu();
            }
        });
        
        // Window resize - büyük ekranda menüyü kapat
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth > 1024 && isMenuOpen) {
                    closeMenu();
                }
            }, 250);
        });
        
        // Orientation change
        window.addEventListener('orientationchange', function() {
            if (isMenuOpen) {
                closeMenu();
            }
        });
        
        console.log('✅ Mobil menü event listeners yüklendi');
    }
    
    /**
     * Focus Trap - Menü içinde focus'u tut
     */
    function initFocusTrap() {
        if (!mobileMenu) return;
        
        const focusableElements = mobileMenu.querySelectorAll(
            'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
        );
        
        if (focusableElements.length === 0) return;
        
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];
        
        mobileMenu.addEventListener('keydown', function(e) {
            if (!isMenuOpen) return;
            
            if (e.key === 'Tab') {
                if (e.shiftKey) {
                    // Shift + Tab
                    if (document.activeElement === firstFocusable) {
                        e.preventDefault();
                        lastFocusable.focus();
                    }
                } else {
                    // Tab
                    if (document.activeElement === lastFocusable) {
                        e.preventDefault();
                        firstFocusable.focus();
                    }
                }
            }
        });
        
        console.log('✅ Focus trap aktif');
    }
    
    /**
     * Aktif Sayfa İşaretle
     */
    function markActivePage() {
        const currentPage = window.location.pathname.split('/').pop().replace('.php', '') || 'index';
        
        mobileNavLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href) {
                const linkPage = href.split('/').pop().replace('.php', '') || 'index';
                const parentItem = link.closest('.mobile-nav-item');
                
                if (linkPage === currentPage && parentItem) {
                    parentItem.classList.add('active');
                }
            }
        });
        
        console.log('✅ Aktif sayfa işaretlendi:', currentPage);
    }
    
    /**
     * Touch Gesture Support
     */
    function initTouchGestures() {
        if (!mobileMenu) return;
        
        let touchStartY = 0;
        let touchEndY = 0;
        
        mobileMenu.addEventListener('touchstart', function(e) {
            touchStartY = e.changedTouches[0].screenY;
        }, { passive: true });
        
        mobileMenu.addEventListener('touchend', function(e) {
            touchEndY = e.changedTouches[0].screenY;
            handleSwipe();
        }, { passive: true });
        
        function handleSwipe() {
            const swipeDistance = touchEndY - touchStartY;
            
            // Yukarı swipe - menüyü kapat
            if (swipeDistance < -50 && isMenuOpen) {
                closeMenu();
            }
        }
        
        console.log('✅ Touch gestures aktif');
    }
    
    /**
     * Smooth Scroll
     */
    function initSmoothScroll() {
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Anchor link kontrolü
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    
                    if (target) {
                        closeMenu();
                        
                        setTimeout(() => {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }, 300);
                    }
                }
            });
        });
        
        console.log('✅ Smooth scroll aktif');
    }
    
    /**
     * Accessibility Announcements
     */
    function announceMenuState() {
        // Screen reader için announcement
        const announcement = document.createElement('div');
        announcement.setAttribute('role', 'status');
        announcement.setAttribute('aria-live', 'polite');
        announcement.className = 'sr-only';
        document.body.appendChild(announcement);
        
        // Menü durumu değiştiğinde announce et
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'aria-expanded') {
                    const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
                    announcement.textContent = isExpanded ? 'Menü açıldı' : 'Menü kapatıldı';
                }
            });
        });
        
        if (mobileMenuToggle) {
            observer.observe(mobileMenuToggle, { attributes: true });
        }
        
        console.log('✅ Accessibility announcements aktif');
    }
    
    /**
     * Initialize
     */
    function init() {
        console.log('🚀 Mobil menü başlatılıyor...');
        
        // Elementlerin varlığını kontrol et
        if (!mobileMenuToggle || !mobileMenu) {
            console.warn('⚠️ Mobil menü elementleri bulunamadı');
            return;
        }
        
        // Başlangıç ARIA attributes
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        mobileMenuToggle.setAttribute('aria-controls', 'mobile-menu');
        mobileMenuToggle.setAttribute('aria-label', 'Menüyü aç');
        
        mobileMenu.setAttribute('aria-hidden', 'true');
        mobileMenu.setAttribute('role', 'navigation');
        mobileMenu.setAttribute('aria-label', 'Mobil navigasyon menüsü');
        
        // Özellikleri başlat
        initEventListeners();
        initFocusTrap();
        markActivePage();
        initTouchGestures();
        initSmoothScroll();
        announceMenuState();
        
        console.log('✅ Mobil menü başarıyla yüklendi!');
    }
    
    // DOM yüklendiğinde başlat
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Global API
    window.MobileMenu = {
        open: openMenu,
        close: closeMenu,
        toggle: toggleMenu,
        isOpen: () => isMenuOpen
    };
    
})();

/**
 * Screen Reader Only Class
 */
if (!document.querySelector('style[data-sr-only]')) {
    const srStyle = document.createElement('style');
    srStyle.setAttribute('data-sr-only', 'true');
    srStyle.textContent = `
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
    `;
    document.head.appendChild(srStyle);
}
