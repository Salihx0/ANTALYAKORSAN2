<?php
/**
 * ÇOK DİLLİ DESTEK SİSTEMİ
 * Antalya Korsan Taksi
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

// Oturum başlat (eğer başlatılmamışsa)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Desteklenen diller
define('SUPPORTED_LANGUAGES', [
    'tr' => [
        'name' => 'Türkçe',
        'native' => 'Türkçe',
        'flag' => '🇹🇷',
        'code' => 'tr',
        'locale' => 'tr_TR',
        'direction' => 'ltr'
    ],
    'en' => [
        'name' => 'English',
        'native' => 'English',
        'flag' => '🇬🇧',
        'code' => 'en',
        'locale' => 'en_US',
        'direction' => 'ltr'
    ],
    'ru' => [
        'name' => 'Russian',
        'native' => 'Русский',
        'flag' => '🇷🇺',
        'code' => 'ru',
        'locale' => 'ru_RU',
        'direction' => 'ltr'
    ]
]);

// Varsayılan dil
define('DEFAULT_LANGUAGE', 'tr');

// Mevcut dil
$current_language = DEFAULT_LANGUAGE;

/**
 * Dil dosyasını yükle
 */
function loadLanguage($lang = null) {
    global $current_language, $translations;
    
    // Dil belirtilmemişse mevcut dili kullan
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }
    
    // Dil dosyası yolu
    $lang_file = __DIR__ . '/../lang/' . $lang . '.php';
    
    // Dil dosyası varsa yükle
    if (file_exists($lang_file)) {
        $translations = require $lang_file;
        $current_language = $lang;
        return true;
    }
    
    // Varsayılan dili yükle
    $default_file = __DIR__ . '/../lang/' . DEFAULT_LANGUAGE . '.php';
    if (file_exists($default_file)) {
        $translations = require $default_file;
        $current_language = DEFAULT_LANGUAGE;
        return true;
    }
    
    return false;
}

/**
 * Mevcut dili al
 */
function getCurrentLanguage() {
    global $current_language;
    
    // URL parametresinden dil kontrolü
    if (isset($_GET['lang']) && isValidLanguage($_GET['lang'])) {
        $lang = $_GET['lang'];
        $_SESSION['language'] = $lang;
        setcookie('language', $lang, time() + (86400 * 365), '/');
        return $lang;
    }
    
    // Session'dan dil kontrolü
    if (isset($_SESSION['language']) && isValidLanguage($_SESSION['language'])) {
        return $_SESSION['language'];
    }
    
    // Cookie'den dil kontrolü
    if (isset($_COOKIE['language']) && isValidLanguage($_COOKIE['language'])) {
        $_SESSION['language'] = $_COOKIE['language'];
        return $_COOKIE['language'];
    }
    
    // Tarayıcı dilini kontrol et
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if (isValidLanguage($browser_lang)) {
            $_SESSION['language'] = $browser_lang;
            return $browser_lang;
        }
    }
    
    // Varsayılan dili döndür
    return DEFAULT_LANGUAGE;
}

/**
 * Dil geçerli mi kontrol et
 */
function isValidLanguage($lang) {
    return isset(SUPPORTED_LANGUAGES[$lang]);
}

/**
 * Çeviri al
 */
function __($key, $params = []) {
    global $translations;
    
    // Çeviri varsa döndür
    if (isset($translations[$key])) {
        $translation = $translations[$key];
        
        // Parametreleri değiştir
        if (!empty($params)) {
            foreach ($params as $param_key => $param_value) {
                $translation = str_replace(':' . $param_key, $param_value, $translation);
            }
        }
        
        return $translation;
    }
    
    // Çeviri yoksa anahtarı döndür
    return $key;
}

/**
 * Çeviri al (kısa versiyon)
 */
function t($key, $params = []) {
    return __($key, $params);
}

/**
 * Dil değiştirme URL'i oluştur
 */
function getLanguageUrl($lang) {
    $current_url = $_SERVER['REQUEST_URI'];
    
    // Mevcut dil parametresini kaldır
    $url = preg_replace('/[?&]lang=[^&]*/', '', $current_url);
    
    // Yeni dil parametresini ekle
    $separator = (strpos($url, '?') !== false) ? '&' : '?';
    return $url . $separator . 'lang=' . $lang;
}

/**
 * Dil seçici HTML'i oluştur
 */
function renderLanguageSelector($class = '') {
    $current = getCurrentLanguage();
    $html = '<div class="language-selector ' . $class . '">';
    $html .= '<button class="language-toggle" aria-label="' . __('select_language') . '">';
    $html .= '<span class="flag">' . SUPPORTED_LANGUAGES[$current]['flag'] . '</span>';
    $html .= '<span class="lang-code">' . strtoupper($current) . '</span>';
    $html .= '<i class="fas fa-chevron-down"></i>';
    $html .= '</button>';
    $html .= '<div class="language-dropdown">';
    
    foreach (SUPPORTED_LANGUAGES as $code => $lang) {
        $active = ($code === $current) ? 'active' : '';
        $html .= '<a href="' . getLanguageUrl($code) . '" class="language-option ' . $active . '" data-lang="' . $code . '">';
        $html .= '<span class="flag">' . $lang['flag'] . '</span>';
        $html .= '<span class="lang-name">' . $lang['native'] . '</span>';
        if ($code === $current) {
            $html .= '<i class="fas fa-check"></i>';
        }
        $html .= '</a>';
    }
    
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}

/**
 * Dil bilgilerini al
 */
function getLanguageInfo($lang = null) {
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }
    
    return SUPPORTED_LANGUAGES[$lang] ?? SUPPORTED_LANGUAGES[DEFAULT_LANGUAGE];
}

/**
 * Tüm desteklenen dilleri al
 */
function getSupportedLanguages() {
    return SUPPORTED_LANGUAGES;
}

/**
 * Dil yönünü al (LTR/RTL)
 */
function getLanguageDirection($lang = null) {
    $info = getLanguageInfo($lang);
    return $info['direction'];
}

/**
 * Locale ayarla
 */
function setLanguageLocale($lang = null) {
    $info = getLanguageInfo($lang);
    $locale = $info['locale'];
    
    // Locale ayarla
    setlocale(LC_ALL, $locale . '.UTF-8', $locale . '.utf8', $locale);
    
    // Tarih formatı için
    if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set('Europe/Istanbul');
    }
}

/**
 * Tarih formatla
 */
function formatDate($timestamp, $format = 'long') {
    $lang = getCurrentLanguage();
    
    $formats = [
        'tr' => [
            'short' => 'd.m.Y',
            'medium' => 'd F Y',
            'long' => 'd F Y, l',
            'full' => 'd F Y, l H:i'
        ],
        'en' => [
            'short' => 'm/d/Y',
            'medium' => 'F d, Y',
            'long' => 'l, F d, Y',
            'full' => 'l, F d, Y H:i'
        ],
        'ru' => [
            'short' => 'd.m.Y',
            'medium' => 'd F Y',
            'long' => 'l, d F Y',
            'full' => 'l, d F Y H:i'
        ]
    ];
    
    $date_format = $formats[$lang][$format] ?? $formats['tr'][$format];
    return date($date_format, $timestamp);
}

/**
 * Sayı formatla
 */
function formatNumber($number, $decimals = 0) {
    $lang = getCurrentLanguage();
    
    $formats = [
        'tr' => ['decimal' => ',', 'thousands' => '.'],
        'en' => ['decimal' => '.', 'thousands' => ','],
        'ru' => ['decimal' => ',', 'thousands' => ' ']
    ];
    
    $format = $formats[$lang] ?? $formats['tr'];
    return number_format($number, $decimals, $format['decimal'], $format['thousands']);
}

/**
 * Para formatla
 */
function formatCurrency($amount, $currency = 'TRY') {
    $lang = getCurrentLanguage();
    $formatted = formatNumber($amount, 2);
    
    $symbols = [
        'TRY' => '₺',
        'USD' => '$',
        'EUR' => '€',
        'RUB' => '₽'
    ];
    
    $symbol = $symbols[$currency] ?? $currency;
    
    // Türkçe ve Rusça'da sembol sonra
    if (in_array($lang, ['tr', 'ru'])) {
        return $formatted . ' ' . $symbol;
    }
    
    // İngilizce'de sembol önce
    return $symbol . $formatted;
}

// Dil sistemini başlat
$current_language = getCurrentLanguage();
loadLanguage($current_language);
setLanguageLocale($current_language);

// HTML lang attribute için
define('HTML_LANG', $current_language);
define('HTML_DIR', getLanguageDirection());
