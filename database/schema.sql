-- ============================================
-- ANTALYA KORSAN TAKSİ - VERİTABANI ŞEMASI
-- Tarih: 18 Kasım 2025
-- Versiyon: 1.0
-- ============================================

-- Veritabanı oluştur
CREATE DATABASE IF NOT EXISTS antalyakorsan 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE antalyakorsan;

-- ============================================
-- 1. KULLANICILAR TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'editor', 'author') DEFAULT 'author',
    avatar VARCHAR(255) DEFAULT NULL,
    status ENUM('active', 'inactive', 'banned') DEFAULT 'active',
    last_login DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan admin kullanıcısı
INSERT INTO users (username, email, password, full_name, role, status) VALUES
('admin', 'iletisim@antalyakorsan.com.tr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'admin', 'active');
-- Şifre: admin123 (Değiştirilmeli!)

-- ============================================
-- 2. MAKALELER TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS articles (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255) DEFAULT NULL,
    category VARCHAR(100) DEFAULT 'Genel',
    tags VARCHAR(255) DEFAULT NULL,
    views INT(11) DEFAULT 0,
    status ENUM('draft', 'published', 'scheduled') DEFAULT 'draft',
    published_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- SEO Alanları
    meta_title VARCHAR(255) DEFAULT NULL,
    meta_description TEXT DEFAULT NULL,
    meta_keywords VARCHAR(255) DEFAULT NULL,
    canonical_url VARCHAR(255) DEFAULT NULL,
    og_title VARCHAR(255) DEFAULT NULL,
    og_description TEXT DEFAULT NULL,
    og_image VARCHAR(255) DEFAULT NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_slug (slug),
    INDEX idx_status (status),
    INDEX idx_category (category),
    INDEX idx_published_at (published_at),
    FULLTEXT idx_search (title, content, excerpt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. SAYFALAR TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS pages (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content LONGTEXT NOT NULL,
    template VARCHAR(50) DEFAULT 'default',
    status ENUM('active', 'inactive') DEFAULT 'active',
    order_num INT(11) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- SEO Alanları
    meta_title VARCHAR(255) DEFAULT NULL,
    meta_description TEXT DEFAULT NULL,
    meta_keywords VARCHAR(255) DEFAULT NULL,
    
    INDEX idx_slug (slug),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan sayfalar
INSERT INTO pages (title, slug, content, template, status) VALUES
('Ana Sayfa', 'ana-sayfa', 'Ana sayfa içeriği', 'home', 'active'),
('Hakkımızda', 'hakkimizda', 'Hakkımızda içeriği', 'about', 'active'),
('Hizmetler', 'hizmetler', 'Hizmetler içeriği', 'services', 'active'),
('İletişim', 'iletisim', 'İletişim içeriği', 'contact', 'active');

-- ============================================
-- 4. GALERİ TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS gallery (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT DEFAULT NULL,
    image_path VARCHAR(255) NOT NULL,
    thumbnail_path VARCHAR(255) DEFAULT NULL,
    category VARCHAR(100) DEFAULT 'Genel',
    alt_text VARCHAR(255) DEFAULT NULL,
    order_num INT(11) DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_category (category),
    INDEX idx_status (status),
    INDEX idx_order (order_num)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 5. AYARLAR TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS settings (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    setting_type VARCHAR(50) DEFAULT 'text',
    category VARCHAR(50) DEFAULT 'general',
    description TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_key (setting_key),
    INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan ayarlar
INSERT INTO settings (setting_key, setting_value, setting_type, category, description) VALUES
-- Genel Ayarlar
('site_name', 'Antalya Korsan Taksi', 'text', 'general', 'Site adı'),
('site_tagline', 'Güvenli ve Ekonomik Ulaşım', 'text', 'general', 'Site sloganı'),
('site_description', 'Antalya\'da 7/24 güvenilir korsan taksi hizmeti. Havalimanı transferi, şehir içi ulaşım ve turistik turlar.', 'textarea', 'general', 'Site açıklaması'),
('site_keywords', 'antalya korsan taksi, antalya taksi, havalimanı transfer, korsan taksi', 'text', 'general', 'Site anahtar kelimeleri'),
('site_url', 'http://localhost/antalyakorsan-yeni', 'text', 'general', 'Site URL'),
('site_email', 'iletisim@antalyakorsan.com.tr', 'email', 'general', 'Site email'),
('site_phone', '+905070073210', 'text', 'general', 'Site telefon'),
('site_whatsapp', '+905070073210', 'text', 'general', 'WhatsApp numarası'),
('site_address', 'Markantalya Adresi, Antalya', 'textarea', 'general', 'Site adresi'),
('site_instagram', 'antalyaktaksi', 'text', 'general', 'Instagram kullanıcı adı'),

-- Tema Ayarları
('active_theme', 'corporate', 'select', 'theme', 'Aktif tema'),
('logo_path', '/assets/images/logo/logo.png', 'text', 'theme', 'Logo yolu'),
('favicon_path', '/assets/images/logo/favicon.ico', 'text', 'theme', 'Favicon yolu'),
('primary_color', '#FFD700', 'color', 'theme', 'Ana renk'),
('secondary_color', '#1A1A1A', 'color', 'theme', 'İkincil renk'),

-- SEO Ayarları
('seo_enabled', '1', 'boolean', 'seo', 'SEO aktif'),
('sitemap_enabled', '1', 'boolean', 'seo', 'Sitemap aktif'),
('robots_txt_enabled', '1', 'boolean', 'seo', 'Robots.txt aktif'),
('schema_enabled', '1', 'boolean', 'seo', 'Schema markup aktif'),
('og_enabled', '1', 'boolean', 'seo', 'Open Graph aktif'),

-- Google Entegrasyonları
('google_analytics_id', '', 'text', 'integrations', 'Google Analytics ID'),
('google_search_console_verified', '0', 'boolean', 'integrations', 'Search Console doğrulandı'),
('google_maps_api_key', '', 'text', 'integrations', 'Google Maps API Key'),

-- Email Ayarları
('smtp_enabled', '0', 'boolean', 'email', 'SMTP aktif'),
('smtp_host', '', 'text', 'email', 'SMTP host'),
('smtp_port', '587', 'text', 'email', 'SMTP port'),
('smtp_username', '', 'text', 'email', 'SMTP kullanıcı adı'),
('smtp_password', '', 'password', 'email', 'SMTP şifre'),

-- Bakım Modu
('maintenance_mode', '0', 'boolean', 'general', 'Bakım modu'),
('maintenance_message', 'Site bakımda. Lütfen daha sonra tekrar deneyin.', 'textarea', 'general', 'Bakım modu mesajı');

-- ============================================
-- 6. SEO AYARLARI TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS seo_settings (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    page_type VARCHAR(50) NOT NULL,
    page_id INT(11) DEFAULT NULL,
    meta_title VARCHAR(255) DEFAULT NULL,
    meta_description TEXT DEFAULT NULL,
    meta_keywords VARCHAR(255) DEFAULT NULL,
    canonical_url VARCHAR(255) DEFAULT NULL,
    og_title VARCHAR(255) DEFAULT NULL,
    og_description TEXT DEFAULT NULL,
    og_image VARCHAR(255) DEFAULT NULL,
    og_type VARCHAR(50) DEFAULT 'website',
    twitter_card VARCHAR(50) DEFAULT 'summary_large_image',
    twitter_title VARCHAR(255) DEFAULT NULL,
    twitter_description TEXT DEFAULT NULL,
    twitter_image VARCHAR(255) DEFAULT NULL,
    schema_markup TEXT DEFAULT NULL,
    robots_index ENUM('index', 'noindex') DEFAULT 'index',
    robots_follow ENUM('follow', 'nofollow') DEFAULT 'follow',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_page_type (page_type),
    INDEX idx_page_id (page_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 7. İLETİŞİM MESAJLARI TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS contacts (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    subject VARCHAR(255) DEFAULT NULL,
    message TEXT NOT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
    replied_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_status (status),
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 8. SİSTEM LOGLARI TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS logs (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) UNSIGNED DEFAULT NULL,
    action VARCHAR(100) NOT NULL,
    description TEXT DEFAULT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    log_level ENUM('info', 'warning', 'error', 'critical') DEFAULT 'info',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_log_level (log_level),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 9. REDIRECTS TABLOSU (301 Yönlendirmeler)
-- ============================================
CREATE TABLE IF NOT EXISTS redirects (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    old_url VARCHAR(255) NOT NULL UNIQUE,
    new_url VARCHAR(255) NOT NULL,
    redirect_type INT(3) DEFAULT 301,
    hits INT(11) DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_old_url (old_url),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 10. SESSIONS TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(128) NOT NULL PRIMARY KEY,
    user_id INT(11) UNSIGNED DEFAULT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    payload TEXT NOT NULL,
    last_activity INT(11) NOT NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_last_activity (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 11. YORUMLAR TABLOSU (Opsiyonel)
-- ============================================
CREATE TABLE IF NOT EXISTS comments (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    article_id INT(11) UNSIGNED NOT NULL,
    parent_id INT(11) UNSIGNED DEFAULT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    website VARCHAR(255) DEFAULT NULL,
    comment TEXT NOT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    status ENUM('pending', 'approved', 'spam', 'trash') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES comments(id) ON DELETE CASCADE,
    INDEX idx_article_id (article_id),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 12. MENU TABLOSU
-- ============================================
CREATE TABLE IF NOT EXISTS menus (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    parent_id INT(11) UNSIGNED DEFAULT NULL,
    title VARCHAR(100) NOT NULL,
    url VARCHAR(255) NOT NULL,
    target VARCHAR(20) DEFAULT '_self',
    icon VARCHAR(50) DEFAULT NULL,
    order_num INT(11) DEFAULT 0,
    location VARCHAR(50) DEFAULT 'header',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (parent_id) REFERENCES menus(id) ON DELETE CASCADE,
    INDEX idx_parent_id (parent_id),
    INDEX idx_location (location),
    INDEX idx_order (order_num)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan menü öğeleri
INSERT INTO menus (title, url, order_num, location, status) VALUES
('Ana Sayfa', '/', 1, 'header', 'active'),
('Hakkımızda', '/hakkimizda', 2, 'header', 'active'),
('Hizmetler', '/hizmetler', 3, 'header', 'active'),
('Fiyatlar', '/fiyatlar', 4, 'header', 'active'),
('Blog', '/blog', 5, 'header', 'active'),
('Galeri', '/galeri', 6, 'header', 'active'),
('İletişim', '/iletisim', 7, 'header', 'active');

-- ============================================
-- VERİTABANI OLUŞTURMA TAMAMLANDI
-- ============================================

-- Veritabanı bilgileri
SELECT 
    'Veritabanı başarıyla oluşturuldu!' AS message,
    COUNT(*) AS total_tables
FROM information_schema.tables 
WHERE table_schema = 'antalyakorsan';

-- Tablo listesi
SELECT 
    table_name AS 'Tablo Adı',
    table_rows AS 'Kayıt Sayısı',
    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Boyut (MB)'
FROM information_schema.tables
WHERE table_schema = 'antalyakorsan'
ORDER BY table_name;
