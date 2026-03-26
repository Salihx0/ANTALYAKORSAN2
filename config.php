<?php
/**
 * ANTALYA KORSAN TAKSİ - KONFIGÜRASYON DOSYASI
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

// Hata raporlama (Production'da kapatılmalı)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone ayarı
date_default_timezone_set('Europe/Istanbul');

// Session başlat
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// VERİTABANI AYARLARI - cPanel
// ============================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'antalyakorsancom_antalyakorsan');
define('DB_USER', 'antalyakorsancom_burak');
define('DB_PASS', '+oSPbpDQfWM)V7xr');
define('DB_CHARSET', 'utf8mb4');

// ============================================
// SİTE AYARLARI
// ============================================
define('SITE_NAME', 'Antalya Korsan Taksi');
define('SITE_TAGLINE', 'Güvenli ve Ekonomik Ulaşım');
define('SITE_DESCRIPTION', 'Antalya\'da 7/24 güvenilir korsan taksi hizmeti. Havalimanı transferi, şehir içi ulaşım ve turistik turlar.');
define('SITE_KEYWORDS', 'antalya korsan taksi, antalya taksi, havalimanı transfer, korsan taksi');
define('SITE_URL', 'https://antalyakorsan.com.tr');
define('SITE_LANGUAGE', 'tr');

// ============================================
// İLETİŞİM BİLGİLERİ
// ============================================
define('CONTACT_EMAIL', 'iletisim@antalyakorsan.com.tr');
define('CONTACT_PHONE', '+905070073210');
define('CONTACT_WHATSAPP', '+905070073210');
define('CONTACT_ADDRESS', 'Markantalya Adresi, Antalya');
define('CONTACT_INSTAGRAM', 'antalyaktaksi');
define('CONTACT_FACEBOOK', '');
define('CONTACT_TWITTER', '');
define('CONTACT_YOUTUBE', '');

// ============================================
// ÇALIŞMA SAATLERİ
// ============================================
define('WORKING_HOURS', '7/24 Hizmet');
define('WORKING_DAYS', 'Her Gün');

// ============================================
// DOSYA YOLLARI
// ============================================
define('ROOT_PATH', __DIR__);
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('ADMIN_PATH', ROOT_PATH . '/admin');
define('UPLOADS_PATH', ROOT_PATH . '/uploads');

// URL Yolları
define('ASSETS_URL', SITE_URL . '/assets');
define('UPLOADS_URL', SITE_URL . '/uploads');
define('ADMIN_URL', SITE_URL . '/admin');

// ============================================
// GÜVENLİK AYARLARI
// ============================================
define('SECURITY_SALT', 'antalya_korsan_taksi_2025_secure_salt_key');
define('SESSION_LIFETIME', 3600); // 1 saat
define('REMEMBER_ME_LIFETIME', 2592000); // 30 gün
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_TIMEOUT', 900); // 15 dakika

// CSRF Token
define('CSRF_TOKEN_NAME', 'csrf_token');
define('CSRF_TOKEN_LIFETIME', 3600);

// ============================================
// UPLOAD AYARLARI
// ============================================
define('MAX_FILE_SIZE', 5242880); // 5MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('ALLOWED_FILE_TYPES', ['pdf', 'doc', 'docx', 'xls', 'xlsx']);
define('IMAGE_QUALITY', 85);
define('THUMBNAIL_WIDTH', 300);
define('THUMBNAIL_HEIGHT', 300);

// ============================================
// TEMA AYARLARI
// ============================================
define('DEFAULT_THEME', 'corporate');
define('AVAILABLE_THEMES', ['corporate', 'dark', 'light']);

// ============================================
// SEO AYARLARI
// ============================================
define('SEO_ENABLED', true);
define('SITEMAP_ENABLED', true);
define('ROBOTS_ENABLED', true);
define('SCHEMA_ENABLED', true);
define('OG_ENABLED', true);

// Meta Defaults
define('DEFAULT_META_TITLE', SITE_NAME . ' - ' . SITE_TAGLINE);
define('DEFAULT_META_DESCRIPTION', SITE_DESCRIPTION);
define('DEFAULT_META_KEYWORDS', SITE_KEYWORDS);
define('DEFAULT_OG_IMAGE', ASSETS_URL . '/images/logo/og-image.jpg');

// ============================================
// GOOGLE ENTEGRASYONLARI
// ============================================
define('GOOGLE_ANALYTICS_ID', 'G-94JHDY3CJ4'); // G-XXXXXXXXXX
define('GOOGLE_SEARCH_CONSOLE_VERIFIED', true);
define('GOOGLE_MAPS_API_KEY', '');
define('GOOGLE_RECAPTCHA_SITE_KEY', '');
define('GOOGLE_RECAPTCHA_SECRET_KEY', '');

// ============================================
// EMAIL AYARLARI
// ============================================
define('SMTP_ENABLED', false);
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');
define('SMTP_ENCRYPTION', 'tls');
define('MAIL_FROM_EMAIL', CONTACT_EMAIL);
define('MAIL_FROM_NAME', SITE_NAME);

// ============================================
// PAGINATION AYARLARI
// ============================================
define('POSTS_PER_PAGE', 12);
define('ADMIN_POSTS_PER_PAGE', 20);
define('PAGINATION_RANGE', 3);

// ============================================
// CACHE AYARLARI
// ============================================
define('CACHE_ENABLED', true);
define('CACHE_LIFETIME', 3600); // 1 saat
define('CACHE_PATH', ROOT_PATH . '/cache');

// ============================================
// LOG AYARLARI
// ============================================
define('LOG_ENABLED', true);
define('LOG_PATH', ROOT_PATH . '/logs');
define('LOG_LEVEL', 'info'); // debug, info, warning, error, critical

// ============================================
// BAKIM MODU
// ============================================
define('MAINTENANCE_MODE', false);
define('MAINTENANCE_MESSAGE', 'Site bakımda. Lütfen daha sonra tekrar deneyin.');
define('MAINTENANCE_ALLOWED_IPS', ['127.0.0.1', '::1']);

// ============================================
// API AYARLARI
// ============================================
define('API_ENABLED', false);
define('API_KEY', '');
define('API_RATE_LIMIT', 100); // İstek/saat

// ============================================
// WHATSAPP AYARLARI
// ============================================
define('WHATSAPP_NUMBER', '+905070073210');
define('WHATSAPP_MESSAGE', 'Merhaba, araç çağırmak istiyorum.');
define('WHATSAPP_WIDGET_ENABLED', true);
define('WHATSAPP_WIDGET_POSITION', 'bottom-right'); // bottom-right, bottom-left

// ============================================
// SOSYAL MEDYA PAYLAŞIM
// ============================================
define('SOCIAL_SHARE_ENABLED', true);
define('SOCIAL_SHARE_PLATFORMS', ['facebook', 'twitter', 'whatsapp', 'linkedin']);

// ============================================
// YORUM SİSTEMİ
// ============================================
define('COMMENTS_ENABLED', true);
define('COMMENTS_MODERATION', true);
define('COMMENTS_PER_PAGE', 20);

// ============================================
// BREADCRUMB AYARLARI
// ============================================
define('BREADCRUMB_ENABLED', true);
define('BREADCRUMB_HOME_TEXT', 'Ana Sayfa');
define('BREADCRUMB_SEPARATOR', ' / ');

// ============================================
// ANIMASYON AYARLARI
// ============================================
define('PRELOADER_ENABLED', true);
define('PRELOADER_DURATION', 2000); // ms
define('CUSTOM_CURSOR_ENABLED', true);
define('PARALLAX_ENABLED', true);
define('SMOOTH_SCROLL_ENABLED', true);

// ============================================
// PERFORMANS AYARLARI
// ============================================
define('MINIFY_HTML', true);
define('MINIFY_CSS', true);
define('MINIFY_JS', true);
define('LAZY_LOAD_IMAGES', true);
define('WEBP_ENABLED', true);

// ============================================
// GÜVENLİK HEADERS
// ============================================
if (!headers_sent()) {
    // XSS Protection
    header('X-XSS-Protection: 1; mode=block');
    
    // Clickjacking Protection
    header('X-Frame-Options: SAMEORIGIN');
    
    // MIME Type Sniffing Protection
    header('X-Content-Type-Options: nosniff');
    
    // Referrer Policy
    header('Referrer-Policy: strict-origin-when-cross-origin');
    
    // Content Security Policy (Geliştirme aşamasında gevşek)
    // header("Content-Security-Policy: default-src 'self' 'unsafe-inline' 'unsafe-eval' https: data:;");
}

// ============================================
// AUTOLOAD
// ============================================
require_once INCLUDES_PATH . '/db.php';
require_once INCLUDES_PATH . '/functions.php';
require_once INCLUDES_PATH . '/seo.php';

// ============================================
// BAKIM MODU KONTROLÜ
// ============================================
if (MAINTENANCE_MODE && !in_array($_SERVER['REMOTE_ADDR'], MAINTENANCE_ALLOWED_IPS)) {
    if (!defined('ADMIN_AREA')) {
        http_response_code(503);
        include ROOT_PATH . '/maintenance.php';
        exit;
    }
}

// ============================================
// GLOBAL DEĞİŞKENLER
// ============================================
$GLOBALS['db'] = null;
$GLOBALS['current_user'] = null;
$GLOBALS['settings'] = [];

// ============================================
// YARDIMCI FONKSİYONLAR
// ============================================

/**
 * Site URL'ini döndürür
 */
function site_url($path = '') {
    return SITE_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * Assets URL'ini döndürür
 */
function assets_url($path = '') {
    return ASSETS_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * Admin URL'ini döndürür
 */
function admin_url($path = '') {
    return ADMIN_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * Uploads URL'ini döndürür
 */
function uploads_url($path = '') {
    return UPLOADS_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * Güvenli redirect
 */
function safe_redirect($url, $status_code = 302) {
    if (!headers_sent()) {
        header('Location: ' . $url, true, $status_code);
        exit;
    }
}

/**
 * Debug fonksiyonu
 */
function debug($data, $die = false) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($die) die();
}

/**
 * Ayar değerini getir
 */
function get_setting($key, $default = null) {
    global $settings;
    return $settings[$key] ?? $default;
}

/**
 * Ayar değerini kaydet
 */
function set_setting($key, $value) {
    global $settings;
    $settings[$key] = $value;
    // Veritabanına kaydet
    return update_setting($key, $value);
}

// ============================================
// BAŞLATMA
// ============================================

// Veritabanı bağlantısı
try {
    $GLOBALS['db'] = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    if (defined('DEBUG') && DEBUG) {
        die("Veritabanı bağlantı hatası: " . $e->getMessage());
    } else {
        die("Veritabanı bağlantı hatası. Lütfen daha sonra tekrar deneyin.");
    }
}

// Ayarları yükle
$GLOBALS['settings'] = load_settings();

// ============================================
// KONFİGÜRASYON TAMAMLANDI
// ============================================
