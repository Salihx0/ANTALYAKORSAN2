/**
 * DİL SEÇİCİ JAVASCRIPT
 * Antalya Korsan Taksi
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // Language Selector Class
    class LanguageSelector {
        constructor() {
            this.selector = document.querySelector('.language-selector');
            this.toggle = document.querySelector('.language-toggle');
            this.dropdown = document.querySelector('.language-dropdown');
            this.options = document.querySelectorAll('.language-option');
            this.currentLang = this.getCurrentLanguage();
            
            if (this.selector && this.toggle && this.dropdown) {
                this.init();
            }
        }

        init() {
            // Toggle dropdown
            this.toggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.toggleDropdown();
            });

            // Language option click
            this.options.forEach(option => {
                option.addEventListener('click', (e) => {
                    const lang = option.dataset.lang;
                    if (lang && lang !== this.currentLang) {
                        this.changeLanguage(lang);
                    }
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!this.selector.contains(e.target)) {
                    this.closeDropdown();
                }
            });

            // Close dropdown on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    this.closeDropdown();
                }
            });

            // Keyboard navigation
            this.setupKeyboardNavigation();

            // Save language preference
            this.saveLanguagePreference();
        }

        toggleDropdown() {
            const isActive = this.selector.classList.contains('active');
            
            if (isActive) {
                this.closeDropdown();
            } else {
                this.openDropdown();
            }
        }

        openDropdown() {
            this.selector.classList.add('active');
            this.dropdown.classList.add('show');
            this.toggle.setAttribute('aria-expanded', 'true');
            
            // Focus first option
            const firstOption = this.dropdown.querySelector('.language-option');
            if (firstOption) {
                firstOption.focus();
            }
        }

        closeDropdown() {
            this.selector.classList.remove('active');
            this.dropdown.classList.remove('show');
            this.toggle.setAttribute('aria-expanded', 'false');
        }

        changeLanguage(lang) {
            // Show loading state
            this.showLoading();

            // Get current URL
            const url = new URL(window.location.href);
            
            // Update or add lang parameter
            url.searchParams.set('lang', lang);
            
            // Redirect to new URL
            window.location.href = url.toString();
        }

        getCurrentLanguage() {
            // Get from URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const urlLang = urlParams.get('lang');
            if (urlLang) {
                return urlLang;
            }

            // Get from localStorage
            const storedLang = localStorage.getItem('language');
            if (storedLang) {
                return storedLang;
            }

            // Get from cookie
            const cookieLang = this.getCookie('language');
            if (cookieLang) {
                return cookieLang;
            }

            // Get from browser
            const browserLang = navigator.language || navigator.userLanguage;
            const lang = browserLang.substring(0, 2);
            
            // Check if supported
            const supportedLangs = ['tr', 'en', 'ru'];
            if (supportedLangs.includes(lang)) {
                return lang;
            }

            // Default to Turkish
            return 'tr';
        }

        saveLanguagePreference() {
            // Save to localStorage
            localStorage.setItem('language', this.currentLang);
            
            // Save to cookie (1 year)
            const expiryDate = new Date();
            expiryDate.setFullYear(expiryDate.getFullYear() + 1);
            document.cookie = `language=${this.currentLang}; expires=${expiryDate.toUTCString()}; path=/`;
        }

        getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) {
                return parts.pop().split(';').shift();
            }
            return null;
        }

        showLoading() {
            // Add loading class to toggle
            this.toggle.classList.add('loading');
            
            // Disable toggle
            this.toggle.disabled = true;
            
            // Show loading spinner
            const icon = this.toggle.querySelector('i');
            if (icon) {
                icon.className = 'fas fa-spinner fa-spin';
            }
        }

        setupKeyboardNavigation() {
            this.options.forEach((option, index) => {
                option.addEventListener('keydown', (e) => {
                    switch(e.key) {
                        case 'ArrowDown':
                            e.preventDefault();
                            const nextOption = this.options[index + 1];
                            if (nextOption) {
                                nextOption.focus();
                            }
                            break;
                        
                        case 'ArrowUp':
                            e.preventDefault();
                            const prevOption = this.options[index - 1];
                            if (prevOption) {
                                prevOption.focus();
                            }
                            break;
                        
                        case 'Enter':
                        case ' ':
                            e.preventDefault();
                            option.click();
                            break;
                        
                        case 'Escape':
                            e.preventDefault();
                            this.closeDropdown();
                            this.toggle.focus();
                            break;
                    }
                });
            });
        }
    }

    // Language Switcher Animation
    class LanguageSwitcher {
        constructor() {
            this.init();
        }

        init() {
            // Smooth page transition on language change
            this.setupPageTransition();
            
            // Update page content dynamically (if needed)
            this.updateDynamicContent();
        }

        setupPageTransition() {
            // Add fade-out effect before language change
            const languageOptions = document.querySelectorAll('.language-option');
            
            languageOptions.forEach(option => {
                option.addEventListener('click', (e) => {
                    const currentLang = this.getCurrentLanguage();
                    const newLang = option.dataset.lang;
                    
                    if (newLang !== currentLang) {
                        // Add transition class
                        document.body.classList.add('language-transition');
                        
                        // Fade out
                        setTimeout(() => {
                            document.body.style.opacity = '0';
                        }, 50);
                    }
                });
            });
        }

        updateDynamicContent() {
            // Update any dynamic content that needs translation
            // This can be extended based on needs
            const lang = this.getCurrentLanguage();
            
            // Update HTML lang attribute
            document.documentElement.lang = lang;
            
            // Update meta tags
            this.updateMetaTags(lang);
        }

        updateMetaTags(lang) {
            // Update hreflang links
            const hreflangLinks = document.querySelectorAll('link[hreflang]');
            hreflangLinks.forEach(link => {
                const href = link.getAttribute('href');
                const url = new URL(href, window.location.origin);
                url.searchParams.set('lang', lang);
                link.setAttribute('href', url.toString());
            });
        }

        getCurrentLanguage() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('lang') || localStorage.getItem('language') || 'tr';
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            new LanguageSelector();
            new LanguageSwitcher();
        });
    } else {
        new LanguageSelector();
        new LanguageSwitcher();
    }

    // Export for use in other scripts
    window.LanguageSelector = LanguageSelector;
    window.LanguageSwitcher = LanguageSwitcher;

})();

/**
 * Helper Functions
 */

// Get current language
function getCurrentLanguage() {
    const urlParams = new URLSearchParams(window.location.search);
    const urlLang = urlParams.get('lang');
    if (urlLang) return urlLang;
    
    const storedLang = localStorage.getItem('language');
    if (storedLang) return storedLang;
    
    return 'tr';
}

// Change language
function changeLanguage(lang) {
    const url = new URL(window.location.href);
    url.searchParams.set('lang', lang);
    window.location.href = url.toString();
}

// Get translation (if translations are loaded in JS)
function translate(key, params = {}) {
    // This would need translations object loaded
    // For now, return key
    return key;
}

// Format number based on language
function formatNumber(number, decimals = 0) {
    const lang = getCurrentLanguage();
    
    const formats = {
        'tr': { decimal: ',', thousands: '.' },
        'en': { decimal: '.', thousands: ',' },
        'ru': { decimal: ',', thousands: ' ' }
    };
    
    const format = formats[lang] || formats['tr'];
    
    return number.toLocaleString(lang, {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals
    });
}

// Format currency based on language
function formatCurrency(amount, currency = 'TRY') {
    const lang = getCurrentLanguage();
    
    return new Intl.NumberFormat(lang, {
        style: 'currency',
        currency: currency
    }).format(amount);
}

// Format date based on language
function formatDate(date, format = 'long') {
    const lang = getCurrentLanguage();
    
    const options = {
        'short': { year: 'numeric', month: '2-digit', day: '2-digit' },
        'medium': { year: 'numeric', month: 'long', day: 'numeric' },
        'long': { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' },
        'full': { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long', hour: '2-digit', minute: '2-digit' }
    };
    
    return new Intl.DateTimeFormat(lang, options[format] || options['medium']).format(date);
}

// Export helper functions
window.LanguageHelpers = {
    getCurrentLanguage,
    changeLanguage,
    translate,
    formatNumber,
    formatCurrency,
    formatDate
};
