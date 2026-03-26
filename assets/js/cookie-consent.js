/**
 * Cookie Consent Management System
 * Antalya Korsan Taksi
 */

class CookieConsent {
    constructor() {
        this.cookieName = 'antalyakorsan_cookie_consent';
        this.cookieExpiry = 365; // days
        this.preferences = {
            necessary: true, // Always true
            functional: false,
            analytics: false,
            marketing: false
        };
        
        this.init();
    }

    init() {
        // Check if consent already given
        const consent = this.getConsent();
        
        if (!consent) {
            // Show banner after a short delay
            setTimeout(() => this.showBanner(), 1000);
        } else {
            // Load preferences
            this.preferences = consent;
            this.applyPreferences();
            // Show floating button
            this.showFloatingButton();
        }

        // Setup event listeners
        this.setupEventListeners();
    }

    setupEventListeners() {
        // Accept all button
        document.addEventListener('click', (e) => {
            if (e.target.closest('.cookie-btn-accept')) {
                this.acceptAll();
            }
        });

        // Reject all button
        document.addEventListener('click', (e) => {
            if (e.target.closest('.cookie-btn-reject')) {
                this.rejectAll();
            }
        });

        // Settings button
        document.addEventListener('click', (e) => {
            if (e.target.closest('.cookie-btn-settings')) {
                this.openSettings();
            }
        });

        // Close modal
        document.addEventListener('click', (e) => {
            if (e.target.closest('.cookie-close-btn') || 
                e.target.classList.contains('cookie-settings-modal')) {
                this.closeSettings();
            }
        });

        // Save preferences
        document.addEventListener('click', (e) => {
            if (e.target.closest('.cookie-btn-save')) {
                this.savePreferences();
            }
        });

        // Floating button
        document.addEventListener('click', (e) => {
            if (e.target.closest('.cookie-float-btn')) {
                this.openSettings();
            }
        });

        // Toggle switches
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('cookie-toggle-input')) {
                const category = e.target.dataset.category;
                this.preferences[category] = e.target.checked;
            }
        });
    }

    showBanner() {
        const banner = this.createBanner();
        document.body.appendChild(banner);
        
        // Trigger animation
        setTimeout(() => {
            banner.classList.add('show');
        }, 100);
    }

    hideBanner() {
        const banner = document.querySelector('.cookie-consent-banner');
        if (banner) {
            banner.classList.remove('show');
            setTimeout(() => banner.remove(), 400);
        }
    }

    createBanner() {
        const banner = document.createElement('div');
        banner.className = 'cookie-consent-banner';
        banner.innerHTML = `
            <div class="cookie-consent-content">
                <div class="cookie-icon">
                    <i class="fas fa-cookie-bite"></i>
                </div>
                <div class="cookie-text">
                    <h3>🍪 Çerez Kullanımı</h3>
                    <p>
                        Web sitemizde deneyiminizi iyileştirmek için çerezler kullanıyoruz. 
                        Siteyi kullanmaya devam ederek çerez kullanımını kabul etmiş olursunuz.
                        <a href="cerez-politikasi.php">Çerez Politikası</a>
                    </p>
                </div>
                <div class="cookie-actions">
                    <button class="cookie-btn cookie-btn-accept">
                        <i class="fas fa-check"></i> Tümünü Kabul Et
                    </button>
                    <button class="cookie-btn cookie-btn-settings">
                        <i class="fas fa-cog"></i> Ayarlar
                    </button>
                    <button class="cookie-btn cookie-btn-reject">
                        <i class="fas fa-times"></i> Reddet
                    </button>
                </div>
            </div>
        `;
        return banner;
    }

    openSettings() {
        let modal = document.querySelector('.cookie-settings-modal');
        
        if (!modal) {
            modal = this.createSettingsModal();
            document.body.appendChild(modal);
        }

        // Update toggle states
        this.updateToggleStates();
        
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    closeSettings() {
        const modal = document.querySelector('.cookie-settings-modal');
        if (modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    createSettingsModal() {
        const modal = document.createElement('div');
        modal.className = 'cookie-settings-modal';
        modal.innerHTML = `
            <div class="cookie-settings-content">
                <div class="cookie-settings-header">
                    <h2>
                        <i class="fas fa-cookie-bite"></i>
                        Çerez Ayarları
                    </h2>
                    <button class="cookie-close-btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="cookie-settings-body">
                    <!-- Necessary Cookies -->
                    <div class="cookie-category">
                        <div class="cookie-category-header">
                            <div class="cookie-category-title">
                                <i class="fas fa-check-circle"></i>
                                <h3>Zorunlu Çerezler</h3>
                            </div>
                            <div>
                                <span class="cookie-badge required">Gerekli</span>
                                <label class="cookie-toggle">
                                    <input type="checkbox" class="cookie-toggle-input" 
                                           data-category="necessary" checked disabled>
                                    <span class="cookie-toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        <p class="cookie-category-description">
                            Bu çerezler web sitesinin düzgün çalışması için gereklidir ve devre dışı bırakılamaz.
                        </p>
                        <ul class="cookie-category-items">
                            <li><i class="fas fa-check"></i> Oturum yönetimi</li>
                            <li><i class="fas fa-check"></i> Güvenlik</li>
                            <li><i class="fas fa-check"></i> Dil tercihi</li>
                        </ul>
                    </div>

                    <!-- Functional Cookies -->
                    <div class="cookie-category">
                        <div class="cookie-category-header">
                            <div class="cookie-category-title">
                                <i class="fas fa-cog"></i>
                                <h3>İşlevsel Çerezler</h3>
                            </div>
                            <div>
                                <span class="cookie-badge optional">İsteğe Bağlı</span>
                                <label class="cookie-toggle">
                                    <input type="checkbox" class="cookie-toggle-input" 
                                           data-category="functional">
                                    <span class="cookie-toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        <p class="cookie-category-description">
                            Gelişmiş özellikler ve kişiselleştirme için kullanılır.
                        </p>
                        <ul class="cookie-category-items">
                            <li><i class="fas fa-check"></i> Tema tercihi</li>
                            <li><i class="fas fa-check"></i> Son aramalar</li>
                            <li><i class="fas fa-check"></i> Beni hatırla</li>
                        </ul>
                    </div>

                    <!-- Analytics Cookies -->
                    <div class="cookie-category">
                        <div class="cookie-category-header">
                            <div class="cookie-category-title">
                                <i class="fas fa-chart-bar"></i>
                                <h3>Analitik Çerezler</h3>
                            </div>
                            <div>
                                <span class="cookie-badge optional">İsteğe Bağlı</span>
                                <label class="cookie-toggle">
                                    <input type="checkbox" class="cookie-toggle-input" 
                                           data-category="analytics">
                                    <span class="cookie-toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        <p class="cookie-category-description">
                            Web sitesi kullanımını analiz etmek ve iyileştirmek için kullanılır.
                        </p>
                        <ul class="cookie-category-items">
                            <li><i class="fas fa-check"></i> Google Analytics</li>
                            <li><i class="fas fa-check"></i> Sayfa görüntüleme</li>
                            <li><i class="fas fa-check"></i> Kullanıcı davranışı</li>
                        </ul>
                    </div>

                    <!-- Marketing Cookies -->
                    <div class="cookie-category">
                        <div class="cookie-category-header">
                            <div class="cookie-category-title">
                                <i class="fas fa-bullhorn"></i>
                                <h3>Pazarlama Çerezleri</h3>
                            </div>
                            <div>
                                <span class="cookie-badge optional">İsteğe Bağlı</span>
                                <label class="cookie-toggle">
                                    <input type="checkbox" class="cookie-toggle-input" 
                                           data-category="marketing">
                                    <span class="cookie-toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        <p class="cookie-category-description">
                            Kişiselleştirilmiş reklamlar göstermek için kullanılır.
                        </p>
                        <ul class="cookie-category-items">
                            <li><i class="fas fa-check"></i> Facebook Pixel</li>
                            <li><i class="fas fa-check"></i> Google Ads</li>
                            <li><i class="fas fa-check"></i> Remarketing</li>
                        </ul>
                    </div>
                </div>

                <div class="cookie-settings-footer">
                    <button class="cookie-btn cookie-btn-reject">
                        <i class="fas fa-times"></i> Tümünü Reddet
                    </button>
                    <button class="cookie-btn cookie-btn-save">
                        <i class="fas fa-save"></i> Kaydet
                    </button>
                    <button class="cookie-btn cookie-btn-accept">
                        <i class="fas fa-check"></i> Tümünü Kabul Et
                    </button>
                </div>
            </div>
        `;
        return modal;
    }

    updateToggleStates() {
        Object.keys(this.preferences).forEach(category => {
            const toggle = document.querySelector(`[data-category="${category}"]`);
            if (toggle && !toggle.disabled) {
                toggle.checked = this.preferences[category];
            }
        });
    }

    acceptAll() {
        this.preferences = {
            necessary: true,
            functional: true,
            analytics: true,
            marketing: true
        };
        this.saveConsent();
        this.applyPreferences();
        this.hideBanner();
        this.closeSettings();
        this.showFloatingButton();
        this.showNotification('Tüm çerezler kabul edildi', 'success');
    }

    rejectAll() {
        this.preferences = {
            necessary: true,
            functional: false,
            analytics: false,
            marketing: false
        };
        this.saveConsent();
        this.applyPreferences();
        this.hideBanner();
        this.closeSettings();
        this.showFloatingButton();
        this.showNotification('Sadece zorunlu çerezler kabul edildi', 'info');
    }

    savePreferences() {
        this.saveConsent();
        this.applyPreferences();
        this.closeSettings();
        this.showNotification('Çerez tercihleri kaydedildi', 'success');
    }

    saveConsent() {
        const consent = JSON.stringify(this.preferences);
        const expires = new Date();
        expires.setDate(expires.getDate() + this.cookieExpiry);
        
        document.cookie = `${this.cookieName}=${consent}; expires=${expires.toUTCString()}; path=/; SameSite=Lax`;
    }

    getConsent() {
        const cookies = document.cookie.split(';');
        for (let cookie of cookies) {
            const [name, value] = cookie.trim().split('=');
            if (name === this.cookieName) {
                try {
                    return JSON.parse(value);
                } catch (e) {
                    return null;
                }
            }
        }
        return null;
    }

    applyPreferences() {
        // Apply functional cookies
        if (this.preferences.functional) {
            this.enableFunctionalCookies();
        }

        // Apply analytics cookies
        if (this.preferences.analytics) {
            this.enableAnalytics();
        } else {
            this.disableAnalytics();
        }

        // Apply marketing cookies
        if (this.preferences.marketing) {
            this.enableMarketing();
        } else {
            this.disableMarketing();
        }
    }

    enableFunctionalCookies() {
        // Enable functional features
        console.log('Functional cookies enabled');
    }

    enableAnalytics() {
        // Load Google Analytics
        if (typeof gtag === 'undefined') {
            const script = document.createElement('script');
            script.async = true;
            script.src = 'https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID';
            document.head.appendChild(script);

            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'GA_MEASUREMENT_ID');
        }
        console.log('Analytics enabled');
    }

    disableAnalytics() {
        // Disable Google Analytics
        window['ga-disable-GA_MEASUREMENT_ID'] = true;
        console.log('Analytics disabled');
    }

    enableMarketing() {
        // Load marketing scripts (Facebook Pixel, etc.)
        console.log('Marketing cookies enabled');
    }

    disableMarketing() {
        // Disable marketing scripts
        console.log('Marketing cookies disabled');
    }

    showFloatingButton() {
        let floatBtn = document.querySelector('.cookie-float-btn');
        
        if (!floatBtn) {
            floatBtn = document.createElement('div');
            floatBtn.className = 'cookie-float-btn';
            floatBtn.innerHTML = '<i class="fas fa-cookie-bite"></i>';
            floatBtn.title = 'Çerez Ayarları';
            document.body.appendChild(floatBtn);
        }

        setTimeout(() => {
            floatBtn.classList.add('show');
        }, 500);
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `cookie-notification cookie-notification-${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        `;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#4caf50' : '#2196f3'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 10001;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideInRight 0.3s ease;
        `;

        document.body.appendChild(notification);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        new CookieConsent();
    });
} else {
    new CookieConsent();
}

// Add notification animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Global function to open cookie settings
window.openCookieSettings = function() {
    const event = new Event('click');
    const btn = document.querySelector('.cookie-float-btn');
    if (btn) btn.dispatchEvent(event);
};
