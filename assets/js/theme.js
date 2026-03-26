/**
 * THEME SWITCHER JAVASCRIPT
 * Antalya Korsan Taksi - 3 Tema Sistemi
 * 
 * Temalar:
 * - Corporate (Default)
 * - Dark
 * - Light
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // Tema ayarları
    const THEMES = {
        corporate: {
            name: 'Corporate',
            icon: '🏢',
            colors: {
                primary: '#FFD700',
                secondary: '#FF6B00'
            }
        },
        dark: {
            name: 'Dark',
            icon: '🌙',
            colors: {
                primary: '#FF0000',
                secondary: '#8B0000'
            }
        },
        light: {
            name: 'Light',
            icon: '☀️',
            colors: {
                primary: '#007BFF',
                secondary: '#FFA500'
            }
        }
    };

    // Varsayılan tema
    const DEFAULT_THEME = 'corporate';
    
    // Mevcut tema
    let currentTheme = DEFAULT_THEME;

    /**
     * Tema yükle
     */
    function loadTheme() {
        // LocalStorage'dan tema al
        const savedTheme = localStorage.getItem('antalyakorsan_theme');
        
        if (savedTheme && THEMES[savedTheme]) {
            currentTheme = savedTheme;
        } else {
            // Sistem tercihini kontrol et
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                currentTheme = 'dark';
            }
        }
        
        applyTheme(currentTheme);
    }

    /**
     * Tema uygula
     */
    function applyTheme(theme) {
        if (!THEMES[theme]) {
            console.error('Invalid theme:', theme);
            return;
        }

        currentTheme = theme;
        
        // Body'ye tema attribute'u ekle
        document.body.setAttribute('data-theme', theme);
        
        // LocalStorage'a kaydet
        localStorage.setItem('antalyakorsan_theme', theme);
        
        // Meta theme-color güncelle
        updateMetaThemeColor(theme);
        
        // Tema butonlarını güncelle
        updateThemeButtons();
        
        // Event dispatch et
        window.dispatchEvent(new CustomEvent('themeChanged', {
            detail: { theme, colors: THEMES[theme].colors }
        }));
        
        console.log('✅ Theme applied:', theme);
    }

    /**
     * Meta theme-color güncelle
     */
    function updateMetaThemeColor(theme) {
        let metaThemeColor = document.querySelector('meta[name="theme-color"]');
        
        if (!metaThemeColor) {
            metaThemeColor = document.createElement('meta');
            metaThemeColor.name = 'theme-color';
            document.head.appendChild(metaThemeColor);
        }
        
        const colors = {
            corporate: '#1A1A1A',
            dark: '#000000',
            light: '#FFFFFF'
        };
        
        metaThemeColor.content = colors[theme];
    }

    /**
     * Tema butonlarını güncelle
     */
    function updateThemeButtons() {
        const buttons = document.querySelectorAll('.theme-option, .theme-btn');
        
        buttons.forEach(btn => {
            const btnTheme = btn.getAttribute('data-theme');
            
            if (btnTheme === currentTheme) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    /**
     * Tema değiştir
     */
    function switchTheme(theme) {
        if (theme === currentTheme) return;
        
        // Geçiş animasyonu
        document.body.classList.add('theme-transitioning');
        
        setTimeout(() => {
            applyTheme(theme);
            
            setTimeout(() => {
                document.body.classList.remove('theme-transitioning');
            }, 300);
        }, 150);
    }

    /**
     * Sonraki temaya geç
     */
    function nextTheme() {
        const themeKeys = Object.keys(THEMES);
        const currentIndex = themeKeys.indexOf(currentTheme);
        const nextIndex = (currentIndex + 1) % themeKeys.length;
        switchTheme(themeKeys[nextIndex]);
    }

    /**
     * Önceki temaya geç
     */
    function previousTheme() {
        const themeKeys = Object.keys(THEMES);
        const currentIndex = themeKeys.indexOf(currentTheme);
        const prevIndex = (currentIndex - 1 + themeKeys.length) % themeKeys.length;
        switchTheme(themeKeys[prevIndex]);
    }

    /**
     * Header tema butonlarına event listener ekle
     */
    function setupHeaderThemeButtons() {
        // Theme toggle button
        const themeToggle = document.getElementById('theme-toggle');
        const themeDropdown = document.getElementById('theme-dropdown');
        
        if (themeToggle && themeDropdown) {
            // Toggle dropdown on click
            themeToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                themeDropdown.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!themeToggle.contains(e.target) && !themeDropdown.contains(e.target)) {
                    themeDropdown.classList.remove('show');
                }
            });
        }
        
        // Theme option buttons
        const themeOptions = document.querySelectorAll('.theme-option');
        themeOptions.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const theme = btn.getAttribute('data-theme');
                switchTheme(theme);
                
                // Close dropdown
                if (themeDropdown) {
                    themeDropdown.classList.remove('show');
                }
            });
        });
    }

    /**
     * Keyboard shortcuts
     */
    function setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl + Shift + T: Next theme
            if (e.ctrlKey && e.shiftKey && e.key === 'T') {
                e.preventDefault();
                nextTheme();
                showThemeNotification();
            }
            
            // Ctrl + Shift + 1/2/3: Specific theme
            if (e.ctrlKey && e.shiftKey) {
                if (e.key === '1') {
                    e.preventDefault();
                    switchTheme('corporate');
                    showThemeNotification();
                } else if (e.key === '2') {
                    e.preventDefault();
                    switchTheme('dark');
                    showThemeNotification();
                } else if (e.key === '3') {
                    e.preventDefault();
                    switchTheme('light');
                    showThemeNotification();
                }
            }
        });
    }

    /**
     * Tema değişikliği bildirimi
     */
    function showThemeNotification() {
        // Eski bildirimi kaldır
        const oldNotification = document.querySelector('.theme-notification');
        if (oldNotification) oldNotification.remove();
        
        const notification = document.createElement('div');
        notification.className = 'theme-notification';
        notification.innerHTML = `
            <span class="theme-notification-icon">${THEMES[currentTheme].icon}</span>
            <span class="theme-notification-text">${THEMES[currentTheme].name} Theme</span>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.9);
            color: ${THEMES[currentTheme].colors.primary};
            padding: 15px 25px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: slideInRight 0.3s ease-out;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 2000);
    }

    /**
     * Sistem tema değişikliğini izle
     */
    function watchSystemTheme() {
        if (!window.matchMedia) return;
        
        const darkModeQuery = window.matchMedia('(prefers-color-scheme: dark)');
        
        darkModeQuery.addEventListener('change', (e) => {
            // Sadece kullanıcı manuel tema seçmediyse
            if (!localStorage.getItem('antalyakorsan_theme')) {
                const newTheme = e.matches ? 'dark' : 'light';
                applyTheme(newTheme);
            }
        });
    }

    /**
     * Tema geçiş animasyonu CSS'i ekle
     */
    function addTransitionStyles() {
        const style = document.createElement('style');
        style.textContent = `
            body.theme-transitioning * {
                transition: background-color 0.3s ease,
                           color 0.3s ease,
                           border-color 0.3s ease,
                           box-shadow 0.3s ease !important;
            }
            
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
    }

    /**
     * Initialize
     */
    function init() {
        // Tema yükle
        loadTheme();
        
        // Header tema butonları
        setupHeaderThemeButtons();
        
        // Keyboard shortcuts
        setupKeyboardShortcuts();
        
        // Sistem tema izleme
        watchSystemTheme();
        
        // Transition styles
        addTransitionStyles();
        
        console.log('✅ Theme Switcher initialized');
    }

    /**
     * DOMContentLoaded'da başlat
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    /**
     * Public API
     */
    window.ThemeAPI = {
        current: () => currentTheme,
        switch: switchTheme,
        next: nextTheme,
        previous: previousTheme,
        getThemes: () => THEMES,
        reset: () => {
            localStorage.removeItem('antalyakorsan_theme');
            loadTheme();
        }
    };

})();

/**
 * Kullanım Örnekleri:
 * 
 * 1. Tema değiştir:
 *    ThemeAPI.switch('dark');
 * 
 * 2. Sonraki tema:
 *    ThemeAPI.next();
 * 
 * 3. Mevcut tema:
 *    console.log(ThemeAPI.current());
 * 
 * 4. Tema sıfırla:
 *    ThemeAPI.reset();
 * 
 * 5. Tema değişikliğini dinle:
 *    window.addEventListener('themeChanged', (e) => {
 *        console.log('New theme:', e.detail.theme);
 *    });
 * 
 * Keyboard Shortcuts:
 * - Ctrl + Shift + T: Sonraki tema
 * - Ctrl + Shift + 1: Corporate tema
 * - Ctrl + Shift + 2: Dark tema
 * - Ctrl + Shift + 3: Light tema
 */
