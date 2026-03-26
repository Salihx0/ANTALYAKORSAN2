<?php
/**
 * VERİTABANI FONKSİYONLARI
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

// Config dosyası yüklenmemişse yükle
if (!defined('DB_HOST')) {
    require_once __DIR__ . '/../config.php';
}

/**
 * Veritabanı bağlantısını döndürür
 */
function get_db() {
    return $GLOBALS['db'];
}

// ============================================
// GENEL VERİTABANI FONKSİYONLARI
// ============================================

/**
 * SQL sorgusu çalıştır
 */
function db_query($sql, $params = []) {
    try {
        $db = get_db();
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log("DB Query Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Tek satır getir
 */
function db_fetch($sql, $params = []) {
    $stmt = db_query($sql, $params);
    return $stmt ? $stmt->fetch() : false;
}

/**
 * Tüm satırları getir
 */
function db_fetch_all($sql, $params = []) {
    $stmt = db_query($sql, $params);
    return $stmt ? $stmt->fetchAll() : [];
}

/**
 * Insert işlemi
 */
function db_insert($table, $data) {
    $fields = array_keys($data);
    $values = array_values($data);
    $placeholders = array_fill(0, count($fields), '?');
    
    $sql = "INSERT INTO {$table} (" . implode(', ', $fields) . ") 
            VALUES (" . implode(', ', $placeholders) . ")";
    
    $stmt = db_query($sql, $values);
    return $stmt ? get_db()->lastInsertId() : false;
}

/**
 * Update işlemi
 */
function db_update($table, $data, $where, $where_params = []) {
    $set = [];
    $values = [];
    
    foreach ($data as $field => $value) {
        $set[] = "{$field} = ?";
        $values[] = $value;
    }
    
    $values = array_merge($values, $where_params);
    
    $sql = "UPDATE {$table} SET " . implode(', ', $set) . " WHERE {$where}";
    
    return db_query($sql, $values) !== false;
}

/**
 * Delete işlemi
 */
function db_delete($table, $where, $where_params = []) {
    $sql = "DELETE FROM {$table} WHERE {$where}";
    return db_query($sql, $where_params) !== false;
}

/**
 * Kayıt sayısı
 */
function db_count($table, $where = '1=1', $where_params = []) {
    $sql = "SELECT COUNT(*) as count FROM {$table} WHERE {$where}";
    $result = db_fetch($sql, $where_params);
    return $result ? (int)$result['count'] : 0;
}

// ============================================
// KULLANICI FONKSİYONLARI
// ============================================

/**
 * Kullanıcı getir (ID)
 */
function get_user_by_id($id) {
    return db_fetch("SELECT * FROM users WHERE id = ?", [$id]);
}

/**
 * Kullanıcı getir (Username)
 */
function get_user_by_username($username) {
    return db_fetch("SELECT * FROM users WHERE username = ?", [$username]);
}

/**
 * Kullanıcı getir (Email)
 */
function get_user_by_email($email) {
    return db_fetch("SELECT * FROM users WHERE email = ?", [$email]);
}

/**
 * Kullanıcı oluştur
 */
function create_user($data) {
    // Şifreyi hashle
    if (isset($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    }
    
    return db_insert('users', $data);
}

/**
 * Kullanıcı güncelle
 */
function update_user($id, $data) {
    // Şifre varsa hashle
    if (isset($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    }
    
    return db_update('users', $data, 'id = ?', [$id]);
}

/**
 * Kullanıcı sil
 */
function delete_user($id) {
    return db_delete('users', 'id = ?', [$id]);
}

/**
 * Kullanıcı doğrula
 */
function verify_user($username, $password) {
    $user = get_user_by_username($username);
    
    if ($user && password_verify($password, $user['password'])) {
        // Son giriş zamanını güncelle
        update_user($user['id'], ['last_login' => date('Y-m-d H:i:s')]);
        return $user;
    }
    
    return false;
}

// ============================================
// MAKALE FONKSİYONLARI
// ============================================

/**
 * Makale getir (ID)
 */
function get_article_by_id($id) {
    return db_fetch("SELECT * FROM articles WHERE id = ?", [$id]);
}

/**
 * Makale getir (Slug)
 */
function get_article_by_slug($slug) {
    return db_fetch("SELECT * FROM articles WHERE slug = ? AND status = 'published'", [$slug]);
}

/**
 * Tüm makaleleri getir
 * Not: MySQL native prepared statements LIMIT/OFFSET için placeholder desteklemez.
 * Bu yüzden limit/offset değerleri int'e cast edilerek doğrudan sorguya eklenir.
 */
function get_articles($limit = 10, $offset = 0, $category = null) {
    $limit = max(0, (int)$limit);
    $offset = max(0, (int)$offset);

    $sql = "SELECT a.*, u.full_name as author_name 
            FROM articles a 
            LEFT JOIN users u ON a.user_id = u.id 
            WHERE a.status = 'published'";
    
    $params = [];
    
    if ($category) {
        $sql .= " AND a.category = ?";
        $params[] = $category;
    }
    
    $sql .= " ORDER BY a.published_at DESC LIMIT {$limit} OFFSET {$offset}";
    
    return db_fetch_all($sql, $params);
}

/**
 * Toplam makale sayısı
 */
function count_articles($category = null) {
    $sql = "SELECT COUNT(*) as count 
            FROM articles 
            WHERE status = 'published'";
    $params = [];

    if ($category) {
        $sql .= " AND category = ?";
        $params[] = $category;
    }

    $row = db_fetch($sql, $params);
    return $row ? (int)$row['count'] : 0;
}

/**
 * Makale oluştur
 */
function create_article($data) {
    // Slug oluştur
    if (!isset($data['slug']) && isset($data['title'])) {
        $data['slug'] = create_slug($data['title']);
    }
    
    return db_insert('articles', $data);
}

/**
 * Makale güncelle
 */
function update_article($id, $data) {
    return db_update('articles', $data, 'id = ?', [$id]);
}

/**
 * Makale sil
 */
function delete_article($id) {
    return db_delete('articles', 'id = ?', [$id]);
}

/**
 * Makale görüntüleme sayısını artır
 */
function increment_article_views($id) {
    $sql = "UPDATE articles SET views = views + 1 WHERE id = ?";
    return db_query($sql, [$id]) !== false;
}

/**
 * İlgili makaleler
 */
function get_related_articles($article_id, $category, $limit = 3) {
    $sql = "SELECT * FROM articles 
            WHERE id != ? AND category = ? AND status = 'published' 
            ORDER BY RAND() 
            LIMIT ?";
    
    return db_fetch_all($sql, [$article_id, $category, $limit]);
}

/**
 * Popüler makaleler
 */
function get_popular_articles($limit = 5) {
    $sql = "SELECT * FROM articles 
            WHERE status = 'published' 
            ORDER BY views DESC 
            LIMIT ?";
    
    return db_fetch_all($sql, [$limit]);
}

/**
 * Son makaleler
 */
function get_recent_articles($limit = 5) {
    $sql = "SELECT * FROM articles 
            WHERE status = 'published' 
            ORDER BY published_at DESC 
            LIMIT ?";
    
    return db_fetch_all($sql, [$limit]);
}

/**
 * Makale ara
 */
function search_articles($query, $limit = 10, $offset = 0) {
    $sql = "SELECT * FROM articles 
            WHERE status = 'published' 
            AND (title LIKE ? OR content LIKE ? OR excerpt LIKE ?) 
            ORDER BY published_at DESC 
            LIMIT ? OFFSET ?";
    
    $search = "%{$query}%";
    return db_fetch_all($sql, [$search, $search, $search, $limit, $offset]);
}

/**
 * Kategorileri getir
 */
function get_article_categories() {
    $sql = "SELECT DISTINCT category, COUNT(*) as count 
            FROM articles 
            WHERE status = 'published' 
            GROUP BY category 
            ORDER BY category";
    
    return db_fetch_all($sql);
}

// ============================================
// SAYFA FONKSİYONLARI
// ============================================

/**
 * Sayfa getir (ID)
 */
function get_page_by_id($id) {
    return db_fetch("SELECT * FROM pages WHERE id = ?", [$id]);
}

/**
 * Sayfa getir (Slug)
 */
function get_page_by_slug($slug) {
    return db_fetch("SELECT * FROM pages WHERE slug = ? AND status = 'active'", [$slug]);
}

/**
 * Tüm sayfaları getir
 */
function get_pages() {
    return db_fetch_all("SELECT * FROM pages WHERE status = 'active' ORDER BY order_num ASC");
}

// ============================================
// GALERİ FONKSİYONLARI
// ============================================

/**
 * Galeri öğeleri getir
 */
function get_gallery_items($category = null, $limit = 12, $offset = 0) {
    $sql = "SELECT * FROM gallery WHERE status = 'active'";
    $params = [];
    
    if ($category) {
        $sql .= " AND category = ?";
        $params[] = $category;
    }
    
    $sql .= " ORDER BY order_num ASC, created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    
    return db_fetch_all($sql, $params);
}

/**
 * Galeri kategorileri
 */
function get_gallery_categories() {
    $sql = "SELECT DISTINCT category, COUNT(*) as count 
            FROM gallery 
            WHERE status = 'active' 
            GROUP BY category 
            ORDER BY category";
    
    return db_fetch_all($sql);
}

// ============================================
// AYARLAR FONKSİYONLARI
// ============================================

/**
 * Tüm ayarları yükle
 */
function load_settings() {
    $settings = [];
    $results = db_fetch_all("SELECT setting_key, setting_value FROM settings");
    
    foreach ($results as $row) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    
    return $settings;
}

/**
 * Ayar getir
 */
function get_setting_value($key, $default = null) {
    $result = db_fetch("SELECT setting_value FROM settings WHERE setting_key = ?", [$key]);
    return $result ? $result['setting_value'] : $default;
}

/**
 * Ayar güncelle
 */
function update_setting($key, $value) {
    $exists = db_fetch("SELECT id FROM settings WHERE setting_key = ?", [$key]);
    
    if ($exists) {
        return db_update('settings', ['setting_value' => $value], 'setting_key = ?', [$key]);
    } else {
        return db_insert('settings', [
            'setting_key' => $key,
            'setting_value' => $value
        ]);
    }
}

// ============================================
// İLETİŞİM FONKSİYONLARI
// ============================================

/**
 * İletişim mesajı kaydet
 */
function save_contact_message($data) {
    $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    
    return db_insert('contacts', $data);
}

/**
 * İletişim mesajları getir
 */
function get_contact_messages($status = null, $limit = 20, $offset = 0) {
    $sql = "SELECT * FROM contacts";
    $params = [];
    
    if ($status) {
        $sql .= " WHERE status = ?";
        $params[] = $status;
    }
    
    $sql .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    
    return db_fetch_all($sql, $params);
}

// ============================================
// LOG FONKSİYONLARI
// ============================================

/**
 * Log kaydet
 */
function log_action($action, $description = null, $user_id = null, $level = 'info') {
    $data = [
        'action' => $action,
        'description' => $description,
        'user_id' => $user_id,
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        'log_level' => $level
    ];
    
    return db_insert('logs', $data);
}

/**
 * Logları getir
 */
function get_logs($level = null, $limit = 50, $offset = 0) {
    $sql = "SELECT l.*, u.username 
            FROM logs l 
            LEFT JOIN users u ON l.user_id = u.id";
    $params = [];
    
    if ($level) {
        $sql .= " WHERE l.log_level = ?";
        $params[] = $level;
    }
    
    $sql .= " ORDER BY l.created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    
    return db_fetch_all($sql, $params);
}

// ============================================
// MENU FONKSİYONLARI
// ============================================

/**
 * Menü öğelerini getir
 */
function get_menu_items($location = 'header') {
    $sql = "SELECT * FROM menus 
            WHERE location = ? AND status = 'active' 
            ORDER BY order_num ASC";
    
    return db_fetch_all($sql, [$location]);
}

/**
 * Hiyerarşik menü oluştur
 */
function build_menu_tree($items, $parent_id = null) {
    $tree = [];
    
    foreach ($items as $item) {
        if ($item['parent_id'] == $parent_id) {
            $children = build_menu_tree($items, $item['id']);
            if ($children) {
                $item['children'] = $children;
            }
            $tree[] = $item;
        }
    }
    
    return $tree;
}

// ============================================
// YARDIMCI FONKSİYONLAR
// ============================================

/**
 * Slug oluştur
 */
function create_slug($text) {
    // Türkçe karakterleri dönüştür
    $turkish = ['ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'ç', 'Ç'];
    $english = ['s', 's', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c'];
    $text = str_replace($turkish, $english, $text);
    
    // Küçük harfe çevir
    $text = strtolower($text);
    
    // Özel karakterleri temizle
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    
    // Boşlukları tire ile değiştir
    $text = preg_replace('/[\s-]+/', '-', $text);
    
    // Baştaki ve sondaki tireleri temizle
    $text = trim($text, '-');
    
    return $text;
}

/**
 * Benzersiz slug oluştur
 */
function create_unique_slug($text, $table, $id = null) {
    $slug = create_slug($text);
    $original_slug = $slug;
    $counter = 1;
    
    while (true) {
        $sql = "SELECT id FROM {$table} WHERE slug = ?";
        $params = [$slug];
        
        if ($id) {
            $sql .= " AND id != ?";
            $params[] = $id;
        }
        
        $exists = db_fetch($sql, $params);
        
        if (!$exists) {
            break;
        }
        
        $slug = $original_slug . '-' . $counter;
        $counter++;
    }
    
    return $slug;
}

// ============================================
// VERİTABANI FONKSİYONLARI SONU
// ============================================
