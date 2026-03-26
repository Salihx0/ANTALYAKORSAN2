/**
 * DİL SEÇİCİ STİLLERİ
 * Antalya Korsan Taksi
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

/* ============================================
   LANGUAGE SELECTOR
   ============================================ */
.language-selector {
    position: relative;
    display: inline-block;
    z-index: 1000;
}

.language-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-primary);
}

.language-toggle:hover {
    background: var(--bg-secondary);
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.language-toggle .flag {
    font-size: 20px;
    line-height: 1;
}

.language-toggle .lang-code {
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.language-toggle i {
    font-size: 12px;
    transition: transform 0.3s ease;
}

.language-selector.active .language-toggle i {
    transform: rotate(180deg);
}

/* Dropdown */
.language-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    min-width: 200px;
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    overflow: hidden;
}

.language-selector.active .language-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.language-option {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: var(--text-primary);
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.language-option:hover {
    background: var(--bg-secondary);
    padding-left: 20px;
}

.language-option.active {
    background: var(--primary-color);
    color: var(--text-light);
}

.language-option.active:hover {
    background: var(--primary-dark);
}

.language-option .flag {
    font-size: 24px;
    line-height: 1;
}

.language-option .lang-name {
    flex: 1;
    font-weight: 500;
}

.language-option i {
    font-size: 14px;
    color: var(--text-light);
}

/* Header Language Selector */
.site-header .language-selector {
    margin-left: 20px;
}

.site-header .language-toggle {
    background: transparent;
    border-color: transparent;
    padding: 8px 12px;
}

.site-header .language-toggle:hover {
    background: var(--bg-secondary);
    border-color: var(--primary-color);
}

/* Mobile Language Selector */
@media (max-width: 768px) {
    .language-selector {
        width: 100%;
    }
    
    .language-toggle {
        width: 100%;
        justify-content: space-between;
    }
    
    .language-dropdown {
        left: 0;
        right: 0;
        width: 100%;
    }
    
    .site-header .language-selector {
        margin-left: 0;
        margin-top: 10px;
    }
}

/* ============================================
   LANGUAGE SELECTOR ANIMATIONS
   ============================================ */
@keyframes languageSlideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.language-dropdown.show {
    animation: languageSlideIn 0.3s ease;
}

/* ============================================
   THEME SPECIFIC STYLES
   ============================================ */

/* Light Theme */
body[data-theme="light"] .language-toggle {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(0, 123, 255, 0.2);
}

body[data-theme="light"] .language-toggle:hover {
    background: #FFFFFF;
    border-color: var(--primary-color);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
}

body[data-theme="light"] .language-dropdown {
    background: #FFFFFF;
    border-color: rgba(0, 123, 255, 0.2);
    box-shadow: 0 8px 24px rgba(0, 123, 255, 0.2);
}

body[data-theme="light"] .language-option:hover {
    background: #F8F9FA;
}

/* Dark Theme */
body[data-theme="dark"] .language-toggle {
    background: rgba(30, 30, 30, 0.95);
    border-color: rgba(255, 165, 0, 0.2);
}

body[data-theme="dark"] .language-toggle:hover {
    background: #1E1E1E;
    border-color: var(--primary-color);
    box-shadow: 0 4px 12px rgba(255, 165, 0, 0.2);
}

body[data-theme="dark"] .language-dropdown {
    background: #1E1E1E;
    border-color: rgba(255, 165, 0, 0.2);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
}

body[data-theme="dark"] .language-option:hover {
    background: #2A2A2A;
}

/* Corporate Theme */
body[data-theme="corporate"] .language-toggle {
    background: rgba(26, 35, 126, 0.95);
    border-color: rgba(255, 193, 7, 0.3);
    color: var(--text-light);
}

body[data-theme="corporate"] .language-toggle:hover {
    background: #1A237E;
    border-color: var(--accent-color);
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
}

body[data-theme="corporate"] .language-dropdown {
    background: #1A237E;
    border-color: rgba(255, 193, 7, 0.3);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
}

body[data-theme="corporate"] .language-option {
    color: var(--text-light);
}

body[data-theme="corporate"] .language-option:hover {
    background: rgba(255, 193, 7, 0.1);
}

/* ============================================
   ACCESSIBILITY
   ============================================ */
.language-toggle:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

.language-option:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: -2px;
}

/* Screen Reader Only */
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

/* ============================================
   PRINT STYLES
   ============================================ */
@media print {
    .language-selector {
        display: none;
    }
}

/* ============================================
   COMPACT VERSION
   ============================================ */
.language-selector.compact .language-toggle {
    padding: 6px 10px;
    font-size: 12px;
}

.language-selector.compact .language-toggle .flag {
    font-size: 16px;
}

.language-selector.compact .language-dropdown {
    min-width: 160px;
}

.language-selector.compact .language-option {
    padding: 10px 14px;
}

/* ============================================
   FLOATING VERSION (for mobile)
   ============================================ */
.language-selector.floating {
    position: fixed;
    bottom: 80px;
    right: 20px;
    z-index: 999;
}

.language-selector.floating .language-toggle {
    width: 50px;
    height: 50px;
    padding: 0;
    border-radius: 50%;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.language-selector.floating .language-toggle .lang-code,
.language-selector.floating .language-toggle i {
    display: none;
}

.language-selector.floating .language-dropdown {
    bottom: calc(100% + 8px);
    top: auto;
    right: 0;
}

@media (max-width: 768px) {
    .language-selector.floating {
        bottom: 140px;
    }
}

/* ============================================
   INLINE VERSION (for footer)
   ============================================ */
.language-selector.inline {
    display: inline-flex;
}

.language-selector.inline .language-toggle {
    border: none;
    background: transparent;
    padding: 4px 8px;
}

.language-selector.inline .language-toggle:hover {
    background: var(--bg-secondary);
}

.language-selector.inline .language-dropdown {
    min-width: 180px;
}
