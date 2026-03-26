<?php
/**
 * FOOTER - SITE ALT BİLGİSİ
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config.php';
}
?>
    </main>
    <!-- End Main Content -->
    
    <!-- Footer -->
    <footer class="site-footer" id="site-footer">
        <div class="footer-main">
            <div class="container">
                <div class="footer-content">
                    <!-- Footer Column 1: About -->
                    <div class="footer-column footer-about">
                        <div class="footer-logo">
                            <img src="<?php echo assets_url('images/logo/logo.png'); ?>" alt="<?php echo SITE_NAME; ?>">
                        </div>
                        <p class="footer-description">
                            <?php echo SITE_DESCRIPTION; ?>
                        </p>
                        <div class="footer-social">
                            <?php if (CONTACT_INSTAGRAM): ?>
                            <a href="https://instagram.com/<?php echo CONTACT_INSTAGRAM; ?>" target="_blank" rel="noopener" class="footer-social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (CONTACT_FACEBOOK): ?>
                            <a href="https://facebook.com/<?php echo CONTACT_FACEBOOK; ?>" target="_blank" rel="noopener" class="footer-social-link" aria-label="Facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (CONTACT_TWITTER): ?>
                            <a href="https://twitter.com/<?php echo CONTACT_TWITTER; ?>" target="_blank" rel="noopener" class="footer-social-link" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (CONTACT_YOUTUBE): ?>
                            <a href="https://youtube.com/<?php echo CONTACT_YOUTUBE; ?>" target="_blank" rel="noopener" class="footer-social-link" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Footer Column 2: Quick Links -->
                    <div class="footer-column footer-links">
                        <h3 class="footer-title">Hızlı Linkler</h3>
                        <ul class="footer-menu">
                            <li><a href="<?php echo site_url(); ?>"><i class="fas fa-chevron-right"></i> Ana Sayfa</a></li>
                            <li><a href="<?php echo site_url('hakkimizda'); ?>"><i class="fas fa-chevron-right"></i> Hakkımızda</a></li>
                            <li><a href="<?php echo site_url('hizmetler'); ?>"><i class="fas fa-chevron-right"></i> Hizmetler</a></li>
                            <li><a href="<?php echo site_url('fiyatlar'); ?>"><i class="fas fa-chevron-right"></i> Fiyatlar</a></li>
                            <li><a href="<?php echo site_url('blog'); ?>"><i class="fas fa-chevron-right"></i> Blog</a></li>
                            <li><a href="<?php echo site_url('iletisim'); ?>"><i class="fas fa-chevron-right"></i> İletişim</a></li>
                        </ul>
                    </div>
                    
                    <!-- Footer Column 3: Services -->
                    <div class="footer-column footer-services">
                        <h3 class="footer-title">Hizmetlerimiz</h3>
                        <ul class="footer-menu">
                            <li><a href="<?php echo site_url('hizmetler'); ?>"><i class="fas fa-taxi"></i> Havalimanı Transfer</a></li>
                            <li><a href="<?php echo site_url('hizmetler'); ?>"><i class="fas fa-city"></i> Şehir İçi Ulaşım</a></li>
                            <li><a href="<?php echo site_url('hizmetler'); ?>"><i class="fas fa-map-marked-alt"></i> Turistik Turlar</a></li>
                            <li><a href="<?php echo site_url('hizmetler'); ?>"><i class="fas fa-clock"></i> 7/24 Hizmet</a></li>
                            <li><a href="<?php echo site_url('hizmetler'); ?>"><i class="fas fa-calendar-alt"></i> Özel Gün Transferleri</a></li>
                            <li><a href="<?php echo site_url('hizmetler'); ?>"><i class="fas fa-route"></i> Bölgesel Transfer</a></li>
                        </ul>
                    </div>
                    
                    <!-- Footer Column 4: Contact -->
                    <div class="footer-column footer-contact">
                        <h3 class="footer-title">İletişim</h3>
                        <ul class="footer-contact-list">
                            <li class="footer-contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="footer-contact-text">
                                    <strong>Adres:</strong>
                                    <span><?php echo CONTACT_ADDRESS; ?></span>
                                </div>
                            </li>
                            <li class="footer-contact-item">
                                <i class="fas fa-phone"></i>
                                <div class="footer-contact-text">
                                    <strong>Telefon:</strong>
                                    <a href="tel:<?php echo CONTACT_PHONE; ?>"><?php echo CONTACT_PHONE; ?></a>
                                </div>
                            </li>
                            <li class="footer-contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <div class="footer-contact-text">
                                    <strong>WhatsApp:</strong>
                                    <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>" target="_blank"><?php echo CONTACT_WHATSAPP; ?></a>
                                </div>
                            </li>
                            <li class="footer-contact-item">
                                <i class="fas fa-envelope"></i>
                                <div class="footer-contact-text">
                                    <strong>Email:</strong>
                                    <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
                                </div>
                            </li>
                            <li class="footer-contact-item">
                                <i class="fas fa-clock"></i>
                                <div class="footer-contact-text">
                                    <strong>Çalışma Saatleri:</strong>
                                    <span><?php echo WORKING_HOURS; ?></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="footer-copyright">
                        <p>&copy; <?php echo date('Y'); ?> <strong><?php echo SITE_NAME; ?></strong>. Tüm hakları saklıdır.</p>
                    </div>
                    <div class="footer-links-bottom">
                        <a href="<?php echo site_url('kvkk'); ?>">KVKK</a>
                        <span class="separator">|</span>
                        <a href="<?php echo site_url('gizlilik-politikasi'); ?>">Gizlilik Politikası</a>
                        <span class="separator">|</span>
                        <a href="<?php echo site_url('cerez-politikasi'); ?>">Çerez Politikası</a>
                        <span class="separator">|</span>
                        <a href="<?php echo site_url('hizmet-sozlesmesi'); ?>">Hizmet Sözleşmesi</a>
                        <span class="separator">|</span>
                        <a href="<?php echo site_url('kullanim-kosullari'); ?>">Kullanım Koşulları</a>
                        <span class="separator">|</span>
                        <a href="javascript:void(0);" onclick="openCookieSettings()">Çerez Ayarları</a>
                    </div>
                    <div class="footer-developer" id="footer-developer">
                        <p>Tasarım & Geliştirme: <a href="https://wa.me/905528975831?text=<?php echo urlencode('Merhaba, web sitenizi gördüm. Bilgi almak istiyorum.'); ?>" target="_blank" rel="noopener" class="developer-link" id="developer-name">Burak KAYA</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scroll to Top Button -->
    <button type="button" class="scroll-to-top" id="scroll-to-top" aria-label="Yukarı Çık">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Fixed Contact Buttons (All Pages) -->
    <div class="fixed-contact-buttons" aria-label="Sabit iletişim butonları">
        <a
            href="https://wa.me/905070073210?text=<?php echo urlencode('araç çağırmak istiyorum.'); ?>"
            target="_blank"
            rel="noopener"
            class="fixed-contact-btn fixed-whatsapp-btn"
            aria-label="WhatsApp ile Araç Çağır">
            <i class="fab fa-whatsapp"></i>
            <span>ARAÇ ÇAĞIR</span>
        </a>
        <a
            href="tel:+905070073210"
            class="fixed-contact-btn fixed-phone-btn"
            aria-label="Hemen Ara">
            <i class="fas fa-phone"></i>
            <span>HEMEN ARA</span>
        </a>
    </div>
    
    <!-- Cookie Consent CSS & JS -->
    <link rel="stylesheet" href="<?php echo assets_url('css/cookie-consent.css'); ?>">
    <script src="<?php echo assets_url('js/cookie-consent.js'); ?>"></script>
    
    <!-- JavaScript Files -->
    <script src="<?php echo assets_url('js/main.js'); ?>"></script>
    <?php if (PRELOADER_ENABLED): ?>
    <script src="<?php echo assets_url('js/preloader.js'); ?>"></script>
    <?php endif; ?>
    <?php if (CUSTOM_CURSOR_ENABLED): ?>
    <script src="<?php echo assets_url('js/cursor.js'); ?>"></script>
    <?php endif; ?>
    <script src="<?php echo assets_url('js/theme.js'); ?>"></script>
    <script src="<?php echo assets_url('js/animations.js'); ?>"></script>
    
    <!-- Additional Scripts -->
    <script>
        // Site URL for JavaScript
        const SITE_URL = '<?php echo SITE_URL; ?>';
        const ASSETS_URL = '<?php echo ASSETS_URL; ?>';
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('active');
                    this.classList.toggle('active');
                    document.body.classList.toggle('menu-open');
                });
                
                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!mobileMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                        mobileMenu.classList.remove('active');
                        mobileMenuToggle.classList.remove('active');
                        document.body.classList.remove('menu-open');
                    }
                });
            }
            
            // Scroll to Top
            const scrollToTop = document.getElementById('scroll-to-top');
            if (scrollToTop) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        scrollToTop.classList.add('visible');
                    } else {
                        scrollToTop.classList.remove('visible');
                    }
                });
                
                scrollToTop.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
            
            // Sticky Header
            const header = document.getElementById('site-header');
            if (header) {
                let lastScroll = 0;
                window.addEventListener('scroll', function() {
                    const currentScroll = window.pageYOffset;
                    
                    if (currentScroll > 100) {
                        header.classList.add('sticky');
                        
                        if (currentScroll > lastScroll) {
                            header.classList.add('hide');
                        } else {
                            header.classList.remove('hide');
                        }
                    } else {
                        header.classList.remove('sticky', 'hide');
                    }
                    
                    lastScroll = currentScroll;
                });
            }
            
            // Developer Name Popup Animation
            const developerSection = document.getElementById('footer-developer');
            const developerName = document.getElementById('developer-name');
            
            if (developerSection && developerName) {
                // Intersection Observer for scroll trigger
                const observerOptions = {
                    threshold: 0.5,
                    rootMargin: '0px'
                };
                
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !developerName.classList.contains('animated')) {
                            // Trigger popup animation
                            setTimeout(() => {
                                developerName.classList.add('popup-animation');
                                developerName.classList.add('animated');
                                
                                // Remove animation class after animation completes
                                setTimeout(() => {
                                    developerName.classList.remove('popup-animation');
                                }, 1000);
                            }, 200);
                        }
                    });
                }, observerOptions);
                
                observer.observe(developerSection);
                
                // Add hover effect
                developerName.addEventListener('mouseenter', function() {
                    this.classList.add('hover-pulse');
                });
                
                developerName.addEventListener('mouseleave', function() {
                    this.classList.remove('hover-pulse');
                });
            }
            
            // Lazy Load Images
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    });
                });
                
                document.querySelectorAll('img.lazy').forEach(img => {
                    imageObserver.observe(img);
                });
            }
            
            // Smooth Scroll for Anchor Links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href !== '#' && href !== '#!') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        });
    </script>
    
    <!-- Developer Name Popup Animation Styles -->
    <style>
        .developer-link {
            position: relative;
            display: inline-block;
            font-weight: 600;
            color: var(--primary-color, #FFD700);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .developer-link:hover {
            color: var(--accent-color, #FF6B00);
            transform: translateY(-2px);
        }
        
        /* Popup Animation */
        @keyframes popupBurst {
            0% {
                transform: scale(1);
            }
            25% {
                transform: scale(1.2);
            }
            50% {
                transform: scale(0.95) rotate(-2deg);
            }
            75% {
                transform: scale(1.1) rotate(2deg);
            }
            100% {
                transform: scale(1) rotate(0deg);
            }
        }
        
        @keyframes glowPulse {
            0%, 100% {
                text-shadow: 0 0 5px rgba(255, 215, 0, 0.5),
                             0 0 10px rgba(255, 215, 0, 0.3);
            }
            50% {
                text-shadow: 0 0 20px rgba(255, 215, 0, 0.8),
                             0 0 30px rgba(255, 215, 0, 0.5),
                             0 0 40px rgba(255, 215, 0, 0.3);
            }
        }
        
        .developer-link.popup-animation {
            animation: popupBurst 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55),
                       glowPulse 0.6s ease-in-out;
        }
        
        .developer-link.hover-pulse {
            animation: glowPulse 1s ease-in-out infinite;
        }
        
        /* Sparkle Effect */
        .developer-link::before,
        .developer-link::after {
            content: '✨';
            position: absolute;
            opacity: 0;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .developer-link::before {
            left: -25px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .developer-link::after {
            right: -25px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .developer-link.popup-animation::before,
        .developer-link.popup-animation::after {
            animation: sparkle 0.6s ease-out;
        }
        
        @keyframes sparkle {
            0% {
                opacity: 0;
                transform: translateY(-50%) scale(0);
            }
            50% {
                opacity: 1;
                transform: translateY(-50%) scale(1.2);
            }
            100% {
                opacity: 0;
                transform: translateY(-50%) scale(0.8);
            }
        }
        
        .developer-link:hover::before,
        .developer-link:hover::after {
            opacity: 1;
        }
    </style>
    
    <?php if (isset($additional_scripts)): ?>
        <?php echo $additional_scripts; ?>
    <?php endif; ?>
</body>
</html>
