-- ============================================
-- ANTALYA KORSAN TAKSİ - CPANEL VERİTABANI ŞEMASI
-- Paylaşımlı Hosting İçin Optimize Edilmiş (DÜZELTME)
-- Tarih: 18 Kasım 2025
-- Versiyon: 1.1
-- 
-- NOT: Bu dosyayı phpMyAdmin'de içe aktarın
-- Veritabanı: antalyakorsancom_antalyakorsan
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS=0;
SET time_zone = "+00:00";

-- ============================================
-- TABLOLARI SİL (Foreign Key kontrolü kapalı)
-- ============================================
DROP TABLE IF EXISTS `logs`;
DROP TABLE IF EXISTS `articles`;
DROP TABLE IF EXISTS `contacts`;
DROP TABLE IF EXISTS `menus`;
DROP TABLE IF EXISTS `gallery`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `pages`;
DROP TABLE IF EXISTS `users`;

-- ============================================
-- 1. KULLANICILAR TABLOSU
-- ============================================
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('admin','editor','author') DEFAULT 'author',
  `avatar` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_username` (`username`),
  KEY `idx_email` (`email`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan admin kullanıcısı (Şifre: admin123)
INSERT INTO `users` (`username`, `email`, `password`, `full_name`, `role`, `status`) VALUES
('admin', 'iletisim@antalyakorsan.com.tr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'admin', 'active');

-- ============================================
-- 2. MAKALELER TABLOSU
-- ============================================
CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT 'Genel',
  `tags` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `status` enum('draft','published','scheduled') DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text,
  `og_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_slug` (`slug`),
  KEY `idx_status` (`status`),
  KEY `idx_category` (`category`),
  KEY `idx_published_at` (`published_at`),
  KEY `user_id` (`user_id`),
  FULLTEXT KEY `idx_search` (`title`,`content`,`excerpt`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. SAYFALAR TABLOSU
-- ============================================
CREATE TABLE `pages` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `template` varchar(50) DEFAULT 'default',
  `status` enum('active','inactive') DEFAULT 'active',
  `order_num` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_slug` (`slug`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan sayfalar
INSERT INTO `pages` (`title`, `slug`, `content`, `template`, `status`) VALUES
('Ana Sayfa', 'ana-sayfa', 'Ana sayfa içeriği', 'home', 'active'),
('Hakkımızda', 'hakkimizda', 'Hakkımızda içeriği', 'about', 'active'),
('Hizmetler', 'hizmetler', 'Hizmetler içeriği', 'services', 'active'),
('İletişim', 'iletisim', 'İletişim içeriği', 'contact', 'active');

-- ============================================
-- 4. GALERİ TABLOSU
-- ============================================
CREATE TABLE `gallery` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `image_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT 'Genel',
  `alt_text` varchar(255) DEFAULT NULL,
  `order_num` int(11) DEFAULT '0',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_category` (`category`),
  KEY `idx_status` (`status`),
  KEY `idx_order` (`order_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 5. AYARLAR TABLOSU
-- ============================================
CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text,
  `setting_type` varchar(50) DEFAULT 'text',
  `category` varchar(50) DEFAULT 'general',
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`),
  KEY `idx_key` (`setting_key`),
  KEY `idx_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan ayarlar
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`, `category`, `description`) VALUES
('site_name', 'Antalya Korsan Taksi', 'text', 'general', 'Site adı'),
('site_tagline', 'Güvenli ve Ekonomik Ulaşım', 'text', 'general', 'Site sloganı'),
('site_description', 'Antalya''da 7/24 güvenilir korsan taksi hizmeti. Havalimanı transferi, şehir içi ulaşım ve turistik turlar.', 'textarea', 'general', 'Site açıklaması'),
('site_keywords', 'antalya korsan taksi, antalya taksi, havalimanı transfer, korsan taksi', 'text', 'general', 'Site anahtar kelimeleri'),
('site_url', 'https://antalyakorsan.com.tr', 'text', 'general', 'Site URL'),
('site_email', 'iletisim@antalyakorsan.com.tr', 'email', 'general', 'Site email'),
('site_phone', '+905070073210', 'text', 'general', 'Site telefon'),
('site_whatsapp', '+905070073210', 'text', 'general', 'WhatsApp numarası'),
('site_address', 'Markantalya Adresi, Antalya', 'textarea', 'general', 'Site adresi'),
('site_instagram', 'antalyaktaksi', 'text', 'general', 'Instagram kullanıcı adı'),
('active_theme', 'corporate', 'select', 'theme', 'Aktif tema'),
('logo_path', '/assets/images/logo/logo.png', 'text', 'theme', 'Logo yolu'),
('favicon_path', '/assets/images/logo/favicon.ico', 'text', 'theme', 'Favicon yolu'),
('primary_color', '#FFD700', 'color', 'theme', 'Ana renk'),
('secondary_color', '#1A1A1A', 'color', 'theme', 'İkincil renk'),
('seo_enabled', '1', 'boolean', 'seo', 'SEO aktif'),
('sitemap_enabled', '1', 'boolean', 'seo', 'Sitemap aktif'),
('robots_txt_enabled', '1', 'boolean', 'seo', 'Robots.txt aktif'),
('schema_enabled', '1', 'boolean', 'seo', 'Schema markup aktif'),
('og_enabled', '1', 'boolean', 'seo', 'Open Graph aktif'),
('google_analytics_id', '', 'text', 'integrations', 'Google Analytics ID'),
('google_search_console_verified', '0', 'boolean', 'integrations', 'Search Console doğrulandı'),
('google_maps_api_key', '', 'text', 'integrations', 'Google Maps API Key'),
('smtp_enabled', '0', 'boolean', 'email', 'SMTP aktif'),
('smtp_host', '', 'text', 'email', 'SMTP host'),
('smtp_port', '587', 'text', 'email', 'SMTP port'),
('smtp_username', '', 'text', 'email', 'SMTP kullanıcı adı'),
('smtp_password', '', 'password', 'email', 'SMTP şifre'),
('maintenance_mode', '0', 'boolean', 'general', 'Bakım modu'),
('maintenance_message', 'Site bakımda. Lütfen daha sonra tekrar deneyin.', 'textarea', 'general', 'Bakım modu mesajı');

-- ============================================
-- 6. İLETİŞİM MESAJLARI TABLOSU
-- ============================================
CREATE TABLE `contacts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `status` enum('new','read','replied','archived') DEFAULT 'new',
  `replied_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_email` (`email`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 7. SİSTEM LOGLARI TABLOSU
-- ============================================
CREATE TABLE `logs` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `description` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `log_level` enum('info','warning','error','critical') DEFAULT 'info',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_action` (`action`),
  KEY `idx_log_level` (`log_level`),
  KEY `idx_created_at` (`created_at`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 8. MENU TABLOSU
-- ============================================
CREATE TABLE `menus` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `target` varchar(20) DEFAULT '_self',
  `icon` varchar(50) DEFAULT NULL,
  `order_num` int(11) DEFAULT '0',
  `location` varchar(50) DEFAULT 'header',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_location` (`location`),
  KEY `idx_order` (`order_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan menü öğeleri
INSERT INTO `menus` (`title`, `url`, `order_num`, `location`, `status`) VALUES
('Ana Sayfa', '/', 1, 'header', 'active'),
('Hakkımızda', '/hakkimizda', 2, 'header', 'active'),
('Hizmetler', '/hizmetler', 3, 'header', 'active'),
('Fiyatlar', '/fiyatlar', 4, 'header', 'active'),
('Blog', '/blog', 5, 'header', 'active'),
('İletişim', '/iletisim', 6, 'header', 'active');

-- ============================================
-- Foreign Key kontrolünü tekrar aç
-- ============================================
SET FOREIGN_KEY_CHECKS=1;

-- ============================================
-- VERİTABANI KURULUMU TAMAMLANDI
-- ============================================
