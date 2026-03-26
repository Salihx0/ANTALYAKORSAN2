<?php
/**
 * YARDIMCI FONKSİYONLAR
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

// Config dosyası yüklenmemişse yükle
if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config.php';
}

// ============================================
// GÜVENLİK FONKSİYONLARI
// ============================================

/**
 * XSS temizleme
 */
function clean_input($data) {
    if (is_array($data)) {
        return array_map('clean_input', $data);
    }
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    
    return $data;
}

/**
 * SQL injection koruması
 */
function sanitize_sql($data) {
    return filter_var($data, FILTER_SANITIZE_STRING);
}

/**
 * Email doğrulama
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * URL doğrulama
 */
function validate_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}

/**
 * CSRF token oluştur
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['csrf_token_time'] = time();
    }
    return $_SESSION['csrf_token'];
}

/**
 * CSRF token doğrula
 */
function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || !isset($_SESSION['csrf_token_time'])) {
        return false;
    }
    
    // Token süresi dolmuş mu?
    if (time() - $_SESSION['csrf_token_time'] > CSRF_TOKEN_LIFETIME) {
        unset($_SESSION['csrf_token']);
        unset($_SESSION['csrf_token_time']);
        return false;
    }
    
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Güvenli şifre hash
 */
function hash_password($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

/**
 * Şifre doğrula
 */
function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

// ============================================
// DOSYA İŞLEMLERİ
// ============================================

/**
 * Dosya yükle
 */
function upload_file($file, $destination, $allowed_types = null, $max_size = null) {
    if (!isset($file['error']) || is_array($file['error'])) {
        return ['success' => false, 'message' => 'Geçersiz dosya'];
    }
    
    // Hata kontrolü
    switch ($file['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return ['success' => false, 'message' => 'Dosya çok büyük'];
        case UPLOAD_ERR_NO_FILE:
            return ['success' => false, 'message' => 'Dosya seçilmedi'];
        default:
            return ['success' => false, 'message' => 'Bilinmeyen hata'];
    }
    
    // Boyut kontrolü
    $max_size = $max_size ?? MAX_FILE_SIZE;
    if ($file['size'] > $max_size) {
        return ['success' => false, 'message' => 'Dosya çok büyük'];
    }
    
    // Tip kontrolü
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed_types = $allowed_types ?? ALLOWED_IMAGE_TYPES;
    
    if (!in_array($file_ext, $allowed_types)) {
        return ['success' => false, 'message' => 'Geçersiz dosya tipi'];
    }
    
    // Benzersiz dosya adı oluştur
    $filename = uniqid() . '_' . time() . '.' . $file_ext;
    $filepath = $destination . '/' . $filename;
    
    // Klasör yoksa oluştur
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    
    // Dosyayı taşı
    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['success' => false, 'message' => 'Dosya yüklenemedi'];
    }
    
    return [
        'success' => true,
        'filename' => $filename,
        'filepath' => $filepath,
        'url' => str_replace(ROOT_PATH, SITE_URL, $filepath)
    ];
}

/**
 * Görsel yükle ve optimize et
 */
function upload_image($file, $destination, $create_thumbnail = true) {
    $result = upload_file($file, $destination, ALLOWED_IMAGE_TYPES);
    
    if (!$result['success']) {
        return $result;
    }
    
    // Görseli optimize et
    optimize_image($result['filepath']);
    
    // Thumbnail oluştur
    if ($create_thumbnail) {
        $thumb_path = create_thumbnail($result['filepath'], THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
        $result['thumbnail'] = $thumb_path;
    }
    
    return $result;
}

/**
 * Görsel optimize et
 */
function optimize_image($filepath, $quality = null) {
    $quality = $quality ?? IMAGE_QUALITY;
    
    $info = getimagesize($filepath);
    if (!$info) return false;
    
    $mime = $info['mime'];
    
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($filepath);
            imagejpeg($image, $filepath, $quality);
            break;
        case 'image/png':
            $image = imagecreatefrompng($filepath);
            imagepng($image, $filepath, 9);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($filepath);
            imagegif($image, $filepath);
            break;
        case 'image/webp':
            $image = imagecreatefromwebp($filepath);
            imagewebp($image, $filepath, $quality);
            break;
        default:
            return false;
    }
    
    imagedestroy($image);
    return true;
}

/**
 * Thumbnail oluştur
 */
function create_thumbnail($filepath, $width, $height) {
    $info = getimagesize($filepath);
    if (!$info) return false;
    
    list($orig_width, $orig_height) = $info;
    $mime = $info['mime'];
    
    // Kaynak görsel
    switch ($mime) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($filepath);
            break;
        case 'image/png':
            $source = imagecreatefrompng($filepath);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($filepath);
            break;
        case 'image/webp':
            $source = imagecreatefromwebp($filepath);
            break;
        default:
            return false;
    }
    
    // Oran hesapla
    $ratio = min($width / $orig_width, $height / $orig_height);
    $new_width = $orig_width * $ratio;
    $new_height = $orig_height * $ratio;
    
    // Thumbnail oluştur
    $thumb = imagecreatetruecolor($new_width, $new_height);
    
    // PNG için şeffaflık
    if ($mime == 'image/png') {
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);
    }
    
    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);
    
    // Kaydet
    $thumb_path = str_replace('.', '_thumb.', $filepath);
    
    switch ($mime) {
        case 'image/jpeg':
            imagejpeg($thumb, $thumb_path, IMAGE_QUALITY);
            break;
        case 'image/png':
            imagepng($thumb, $thumb_path, 9);
            break;
        case 'image/gif':
            imagegif($thumb, $thumb_path);
            break;
        case 'image/webp':
            imagewebp($thumb, $thumb_path, IMAGE_QUALITY);
            break;
    }
    
    imagedestroy($source);
    imagedestroy($thumb);
    
    return $thumb_path;
}

/**
 * Dosya sil
 */
function delete_file($filepath) {
    if (file_exists($filepath)) {
        return unlink($filepath);
    }
    return false;
}

// ============================================
// METİN İŞLEMLERİ
// ============================================

/**
 * Metin kısalt
 */
function truncate_text($text, $length = 100, $suffix = '...') {
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    
    return mb_substr($text, 0, $length) . $suffix;
}

/**
 * Özet oluştur
 */
function create_excerpt($text, $length = 200) {
    $text = strip_tags($text);
    $text = preg_replace('/\s+/', ' ', $text);
    return truncate_text($text, $length);
}

/**
 * Kelime sayısı
 */
function word_count($text) {
    $text = strip_tags($text);
    return str_word_count($text);
}

/**
 * Okuma süresi hesapla (dakika)
 */
function reading_time($text, $wpm = 200) {
    $words = word_count($text);
    $minutes = ceil($words / $wpm);
    return $minutes;
}

/**
 * Türkçe karakterleri İngilizce'ye çevir
 */
function tr_to_en($text) {
    $tr = ['ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'ç', 'Ç'];
    $en = ['s', 's', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c'];
    return str_replace($tr, $en, $text);
}

// ============================================
// TARİH VE ZAMAN
// ============================================

/**
 * Tarih formatla
 */
function format_date($date, $format = 'd.m.Y') {
    return date($format, strtotime($date));
}

/**
 * Tarih ve saat formatla
 */
function format_datetime($datetime, $format = 'd.m.Y H:i') {
    return date($format, strtotime($datetime));
}

/**
 * Göreceli zaman (örn: 2 saat önce)
 */
function time_ago($datetime) {
    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp;
    
    if ($diff < 60) {
        return 'Az önce';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' dakika önce';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' saat önce';
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . ' gün önce';
    } elseif ($diff < 2592000) {
        $weeks = floor($diff / 604800);
        return $weeks . ' hafta önce';
    } elseif ($diff < 31536000) {
        $months = floor($diff / 2592000);
        return $months . ' ay önce';
    } else {
        $years = floor($diff / 31536000);
        return $years . ' yıl önce';
    }
}

// ============================================
// PAGINATION
// ============================================

/**
 * Pagination oluştur
 */
function create_pagination($total_items, $items_per_page, $current_page, $base_url) {
    $total_pages = ceil($total_items / $items_per_page);
    
    if ($total_pages <= 1) {
        return '';
    }
    
    $html = '<nav class="pagination" aria-label="Sayfa navigasyonu">';
    $html .= '<ul class="pagination-list">';
    
    // İlk sayfa
    if ($current_page > 1) {
        $html .= '<li><a href="' . $base_url . '?page=1" class="pagination-link">İlk</a></li>';
        $html .= '<li><a href="' . $base_url . '?page=' . ($current_page - 1) . '" class="pagination-link">Önceki</a></li>';
    }
    
    // Sayfa numaraları
    $range = PAGINATION_RANGE;
    $start = max(1, $current_page - $range);
    $end = min($total_pages, $current_page + $range);
    
    for ($i = $start; $i <= $end; $i++) {
        $active = ($i == $current_page) ? ' active' : '';
        $html .= '<li><a href="' . $base_url . '?page=' . $i . '" class="pagination-link' . $active . '">' . $i . '</a></li>';
    }
    
    // Son sayfa
    if ($current_page < $total_pages) {
        $html .= '<li><a href="' . $base_url . '?page=' . ($current_page + 1) . '" class="pagination-link">Sonraki</a></li>';
        $html .= '<li><a href="' . $base_url . '?page=' . $total_pages . '" class="pagination-link">Son</a></li>';
    }
    
    $html .= '</ul>';
    $html .= '</nav>';
    
    return $html;
}

// ============================================
// EMAIL
// ============================================

/**
 * Email gönder
 */
function send_email($to, $subject, $message, $from = null, $from_name = null) {
    $from = $from ?? MAIL_FROM_EMAIL;
    $from_name = $from_name ?? MAIL_FROM_NAME;
    
    $headers = [
        'From: ' . $from_name . ' <' . $from . '>',
        'Reply-To: ' . $from,
        'X-Mailer: PHP/' . phpversion(),
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8'
    ];
    
    if (SMTP_ENABLED) {
        // SMTP ile gönder (PHPMailer kullanılabilir)
        return send_smtp_email($to, $subject, $message, $from, $from_name);
    } else {
        // PHP mail() ile gönder
        return mail($to, $subject, $message, implode("\r\n", $headers));
    }
}

/**
 * İletişim formu email şablonu
 */
function contact_email_template($name, $email, $phone, $subject, $message) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #FFD700; padding: 20px; text-align: center; }
            .content { background: #f9f9f9; padding: 20px; }
            .footer { background: #333; color: #fff; padding: 10px; text-align: center; font-size: 12px; }
            .info { margin: 10px 0; }
            .label { font-weight: bold; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Yeni İletişim Mesajı</h2>
            </div>
            <div class="content">
                <div class="info">
                    <span class="label">Ad Soyad:</span> ' . htmlspecialchars($name) . '
                </div>
                <div class="info">
                    <span class="label">Email:</span> ' . htmlspecialchars($email) . '
                </div>
                <div class="info">
                    <span class="label">Telefon:</span> ' . htmlspecialchars($phone) . '
                </div>
                <div class="info">
                    <span class="label">Konu:</span> ' . htmlspecialchars($subject) . '
                </div>
                <div class="info">
                    <span class="label">Mesaj:</span><br>
                    ' . nl2br(htmlspecialchars($message)) . '
                </div>
            </div>
            <div class="footer">
                <p>&copy; ' . date('Y') . ' Antalya Korsan Taksi. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </body>
    </html>
    ';
    
    return $html;
}

// ============================================
// CACHE
// ============================================

/**
 * Cache kaydet
 */
function cache_set($key, $data, $lifetime = null) {
    if (!CACHE_ENABLED) return false;
    
    $lifetime = $lifetime ?? CACHE_LIFETIME;
    $cache_file = CACHE_PATH . '/' . md5($key) . '.cache';
    
    $cache_data = [
        'data' => $data,
        'expires' => time() + $lifetime
    ];
    
    if (!is_dir(CACHE_PATH)) {
        mkdir(CACHE_PATH, 0755, true);
    }
    
    return file_put_contents($cache_file, serialize($cache_data));
}

/**
 * Cache oku
 */
function cache_get($key) {
    if (!CACHE_ENABLED) return false;
    
    $cache_file = CACHE_PATH . '/' . md5($key) . '.cache';
    
    if (!file_exists($cache_file)) {
        return false;
    }
    
    $cache_data = unserialize(file_get_contents($cache_file));
    
    if ($cache_data['expires'] < time()) {
        unlink($cache_file);
        return false;
    }
    
    return $cache_data['data'];
}

/**
 * Cache temizle
 */
function cache_clear($key = null) {
    if (!CACHE_ENABLED) return false;
    
    if ($key) {
        $cache_file = CACHE_PATH . '/' . md5($key) . '.cache';
        if (file_exists($cache_file)) {
            return unlink($cache_file);
        }
    } else {
        $files = glob(CACHE_PATH . '/*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
        return true;
    }
    
    return false;
}

// ============================================
// DİĞER YARDIMCI FONKSİYONLAR
// ============================================

/**
 * IP adresi al
 */
function get_ip_address() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

/**
 * User agent al
 */
function get_user_agent() {
    return $_SERVER['HTTP_USER_AGENT'] ?? '';
}

/**
 * Mobil cihaz kontrolü
 */
function is_mobile() {
    return preg_match('/(android|iphone|ipad|mobile)/i', get_user_agent());
}

/**
 * AJAX isteği kontrolü
 */
function is_ajax() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

/**
 * JSON response
 */
function json_response($data, $status_code = 200) {
    http_response_code($status_code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Hata mesajı göster
 */
function show_error($message, $code = 500) {
    http_response_code($code);
    include ROOT_PATH . '/error.php';
    exit;
}

/**
 * Başarı mesajı
 */
function success_message($message) {
    $_SESSION['success_message'] = $message;
}

/**
 * Hata mesajı
 */
function error_message($message) {
    $_SESSION['error_message'] = $message;
}

/**
 * Mesajları göster
 */
function display_messages() {
    $html = '';
    
    if (isset($_SESSION['success_message'])) {
        $html .= '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    
    if (isset($_SESSION['error_message'])) {
        $html .= '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    
    return $html;
}

/**
 * Rastgele string oluştur
 */
function random_string($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Array'i CSV'ye çevir
 */
function array_to_csv($array, $filename = 'export.csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    
    // UTF-8 BOM
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Header
    if (!empty($array)) {
        fputcsv($output, array_keys($array[0]));
    }
    
    // Data
    foreach ($array as $row) {
        fputcsv($output, $row);
    }
    
    fclose($output);
    exit;
}

// ============================================
// YARDIMCI FONKSİYONLAR SONU
// ============================================
