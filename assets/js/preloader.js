/**
 * PRELOADER JAVASCRIPT
 * Antalya Korsan Taksi - Yükleme Animasyonu
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // Preloader elementi
    const preloader = document.querySelector('.preloader');
    
    if (!preloader) {
        console.warn('Preloader element not found');
        return;
    }

    // Preloader bileşenleri
    const preloaderText = preloader.querySelector('.preloader-text');
    const preloaderPercentage = preloader.querySelector('.preloader-percentage');
    const preloaderProgressBar = preloader.querySelector('.preloader-progress-bar');
    const preloaderMessage = preloader.querySelector('.preloader-message');

    // Yükleme mesajları
    const loadingMessages = [
        'Araçlar hazırlanıyor...',
        'Sürücüler konumlanıyor...',
        'Rotalar hesaplanıyor...',
        'Sistem kontrol ediliyor...',
        'Neredeyse hazır...'
    ];

    let currentProgress = 0;
    let messageIndex = 0;

    /**
     * Progress bar güncelle
     */
    function updateProgress(progress) {
        currentProgress = Math.min(progress, 100);
        
        if (preloaderProgressBar) {
            preloaderProgressBar.style.width = currentProgress + '%';
        }
        
        if (preloaderPercentage) {
            preloaderPercentage.textContent = Math.floor(currentProgress) + '%';
        }
    }

    /**
     * Mesaj güncelle
     */
    function updateMessage() {
        if (preloaderMessage && loadingMessages[messageIndex]) {
            preloaderMessage.textContent = loadingMessages[messageIndex];
            messageIndex = (messageIndex + 1) % loadingMessages.length;
        }
    }

    /**
     * Simüle edilmiş yükleme
     */
    function simulateLoading() {
        const interval = setInterval(() => {
            if (currentProgress < 90) {
                currentProgress += Math.random() * 15;
                updateProgress(currentProgress);
                
                // Her %20'de bir mesaj değiştir
                if (currentProgress % 20 < 5) {
                    updateMessage();
                }
            } else {
                clearInterval(interval);
            }
        }, 300);
    }

    /**
     * Preloader'ı gizle
     */
    function hidePreloader() {
        updateProgress(100);
        
        setTimeout(() => {
            preloader.classList.add('fade-out');
            
            setTimeout(() => {
                preloader.style.display = 'none';
                document.body.classList.remove('loading');
                
                // Sayfa yüklendi eventi
                window.dispatchEvent(new Event('preloaderHidden'));
            }, 500);
        }, 300);
    }

    /**
     * Gerçek yükleme durumunu izle
     */
    function trackRealLoading() {
        let resourcesLoaded = 0;
        const totalResources = document.images.length + 
                              document.styleSheets.length + 
                              document.scripts.length;

        if (totalResources === 0) {
            updateProgress(100);
            return;
        }

        // Görselleri izle
        Array.from(document.images).forEach(img => {
            if (img.complete) {
                resourcesLoaded++;
                updateProgress((resourcesLoaded / totalResources) * 100);
            } else {
                img.addEventListener('load', () => {
                    resourcesLoaded++;
                    updateProgress((resourcesLoaded / totalResources) * 100);
                });
                img.addEventListener('error', () => {
                    resourcesLoaded++;
                    updateProgress((resourcesLoaded / totalResources) * 100);
                });
            }
        });

        // CSS dosyalarını izle
        Array.from(document.styleSheets).forEach(() => {
            resourcesLoaded++;
            updateProgress((resourcesLoaded / totalResources) * 100);
        });

        // Script dosyalarını izle
        Array.from(document.scripts).forEach(() => {
            resourcesLoaded++;
            updateProgress((resourcesLoaded / totalResources) * 100);
        });
    }

    /**
     * Minimum yükleme süresi
     */
    const minLoadTime = 2000; // 2 saniye
    const startTime = Date.now();

    /**
     * Sayfa yüklendiğinde
     */
    window.addEventListener('load', () => {
        const elapsedTime = Date.now() - startTime;
        const remainingTime = Math.max(0, minLoadTime - elapsedTime);

        setTimeout(() => {
            hidePreloader();
        }, remainingTime);
    });

    /**
     * DOMContentLoaded'da başlat
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            simulateLoading();
            trackRealLoading();
        });
    } else {
        simulateLoading();
        trackRealLoading();
    }

    /**
     * Timeout güvenliği (10 saniye)
     */
    setTimeout(() => {
        if (preloader && !preloader.classList.contains('fade-out')) {
            console.warn('Preloader timeout - forcing hide');
            hidePreloader();
        }
    }, 10000);

    /**
     * Particles oluştur
     */
    function createParticles() {
        const particlesContainer = preloader.querySelector('.preloader-particles');
        
        if (!particlesContainer) return;

        for (let i = 0; i < 5; i++) {
            const particle = document.createElement('div');
            particle.className = 'preloader-particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 3 + 's';
            particlesContainer.appendChild(particle);
        }
    }

    /**
     * Ripple efekti oluştur
     */
    function createRipples() {
        const rippleContainer = preloader.querySelector('.preloader-ripple');
        
        if (!rippleContainer) return;

        for (let i = 0; i < 3; i++) {
            const ripple = document.createElement('div');
            ripple.className = 'preloader-ripple-circle';
            ripple.style.animationDelay = (i * 0.5) + 's';
            rippleContainer.appendChild(ripple);
        }
    }

    /**
     * Taksi animasyonu
     */
    function createTaxiAnimation() {
        const taxi = document.createElement('div');
        taxi.className = 'preloader-taxi';
        taxi.textContent = '🚕';
        preloader.appendChild(taxi);
    }

    // Efektleri başlat
    createParticles();
    createRipples();
    createTaxiAnimation();

    /**
     * Keyboard shortcut - Skip preloader (Development)
     */
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                console.log('Preloader skipped (ESC pressed)');
                hidePreloader();
            }
        });
    }

    /**
     * Public API
     */
    window.PreloaderAPI = {
        hide: hidePreloader,
        updateProgress: updateProgress,
        updateMessage: (msg) => {
            if (preloaderMessage) {
                preloaderMessage.textContent = msg;
            }
        }
    };

})();

/**
 * Preloader HTML Template
 * Bu kodu header.php'ye ekleyin:
 * 
 * <div class="preloader">
 *     <div class="preloader-content">
 *         <div class="preloader-logo">
 *             <img src="<?php echo assets_url('images/logo.png'); ?>" alt="Logo">
 *             <div class="preloader-wheel"></div>
 *         </div>
 *         
 *         <h2 class="preloader-text">Antalya Korsan Taksi</h2>
 *         
 *         <div class="preloader-dots">
 *             <div class="preloader-dot"></div>
 *             <div class="preloader-dot"></div>
 *             <div class="preloader-dot"></div>
 *         </div>
 *         
 *         <div class="preloader-progress">
 *             <div class="preloader-progress-bar"></div>
 *         </div>
 *         
 *         <div class="preloader-percentage">0%</div>
 *         <div class="preloader-message">Yükleniyor...</div>
 *     </div>
 *     
 *     <div class="preloader-particles"></div>
 *     <div class="preloader-ripple"></div>
 * </div>
 */
