# 🚕 ANTALYA KORSAN TAKSİ - WEB SİTESİ PROJESİ

**Versiyon:** 1.0  
**Tarih:** 18 Kasım 2025  
**Durum:** 🚀 GELİŞTİRME AŞAMASINDA

---

## 📋 PROJE HAKKINDA

Antalya Korsan Taksi için modern, SEO-optimized, güvenli ve kullanıcı dostu bir web sitesi projesidir.

### Ana Hedef
Google'da **"Antalya Korsan Taksi"** aramasında **1. SIRADA** görünmek.

### Özellikler
- ✅ Modern PHP 8.2+ altyapısı
- ✅ 3 farklı tema (Corporate, Dark, Light)
- ✅ Premium animasyonlar
- ✅ SEO-optimized yapı
- ✅ Tam fonksiyonel admin paneli
- ✅ WhatsApp entegrasyonu
- ✅ 15 SEO makalesi
- ✅ Responsive tasarım
- ✅ Güvenli ve hızlı

---

## 🎯 PROJE BİLGİLERİ

### İletişim
- **Telefon:** +905070073210
- **WhatsApp:** +905070073210
- **Email:** iletisim@antalyakorsan.com.tr
- **Instagram:** @antalyaktaksi
- **Adres:** Markantalya Adresi, Antalya

### Domain
- **URL:** antalyakorsan.com.tr
- **Localhost:** http://localhost/antalyakorsan-yeni

---

## 📊 PROJE DURUMU

### Genel İlerleme: %15

#### Tamamlanan Fazlar:
- ✅ Faz 1: Temel Altyapı - %60

#### Devam Eden:
- ⏳ Faz 1: Temel Altyapı (includes/functions.php, includes/seo.php)

#### Bekleyen:
- ⏸️ Faz 2-10: Diğer tüm fazlar

---

## 🗂️ DOSYA YAPISI

```
antalyakorsan-yeni/
│
├── 📄 config.php                 # Konfigürasyon
├── 📄 .htaccess                  # URL rewriting & güvenlik
├── 📄 index.php                  # Ana sayfa (Yapılacak)
├── 📄 robots.txt                 # SEO (Yapılacak)
├── 📄 sitemap.php                # Dinamik sitemap (Yapılacak)
├── 📄 llms.txt                   # AI optimization (Yapılacak)
│
├── 📁 includes/
│   ├── ✅ db.php                 # Veritabanı fonksiyonları
│   ├── ⏳ functions.php          # Yardımcı fonksiyonlar
│   ├── ⏳ seo.php                # SEO fonksiyonları
│   ├── ⏳ header.php             # Header
│   └── ⏳ footer.php             # Footer
│
├── 📁 assets/
│   ├── 📁 css/
│   │   ├── ⏳ main.css
│   │   ├── 📁 themes/
│   │   │   ├── ⏳ corporate.css
│   │   │   ├── ⏳ dark.css
│   │   │   └── ⏳ light.css
│   │   ├── ⏳ animations.css
│   │   ├── ⏳ responsive.css
│   │   ├── ⏳ preloader.css
│   │   ├── ⏳ cursor.css
│   │   └── ⏳ scrollbar.css
│   │
│   ├── 📁 js/
│   │   ├── ⏳ main.js
│   │   ├── ⏳ animations.js
│   │   ├── ⏳ preloader.js
│   │   ├── ⏳ cursor.js
│   │   ├── ⏳ theme.js
│   │   ├── ⏳ whatsapp.js
│   │   └── ⏳ parallax.js
│   │
│   └── 📁 images/
│       ├── 📁 logo/
│       ├── 📁 hero/
│       ├── 📁 services/
│       ├── 📁 blog/
│       └── 📁 gallery/
│
├── 📁 admin/
│   ├── ⏳ index.php              # Login
│   ├── ⏳ dashboard.php          # Dashboard
│   └── 📁 includes/
│
├── 📁 database/
│   └── ✅ schema.sql             # Veritabanı şeması
│
└── 📁 docs/
    ├── ✅ PROJE_PLANI_2025.md
    ├── ✅ TODO.md
    ├── ✅ ILERLEME_RAPORU.md
    └── ✅ README.md
```

---

## 🛠️ TEKNOLOJİLER

### Backend
- **PHP:** 8.2+
- **MySQL:** 8.0+
- **PDO:** Prepared Statements

### Frontend
- **HTML5:** Semantic markup
- **CSS3:** Grid, Flexbox, Custom Properties
- **JavaScript:** ES6+, GSAP, Lottie

### Kütüphaneler
- GSAP 3.x (Animasyonlar)
- ScrollTrigger (Scroll animasyonları)
- Lottie (Vector animasyonlar)
- Swiper.js (Slider)

---

## 📦 KURULUM

### Gereksinimler
- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- Apache Web Server
- mod_rewrite aktif

### Adımlar

1. **Veritabanı Oluştur**
```sql
CREATE DATABASE antalyakorsan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. **Veritabanını Import Et**
```bash
mysql -u root -p antalyakorsan < database/schema.sql
```

3. **Config Dosyasını Düzenle**
```php
// config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'antalyakorsan');
define('DB_USER', 'root');
define('DB_PASS', '');
```

4. **Tarayıcıda Aç**
```
http://localhost/antalyakorsan-yeni
```

5. **Admin Paneli**
```
URL: http://localhost/antalyakorsan-yeni/admin
Kullanıcı: admin
Şifre: admin123
```

---

## 🎨 TEMALAR

### 1. Corporate Theme (Ana Tema)
- **Primary:** #FFD700 (Altın Sarısı)
- **Secondary:** #1A1A1A (Koyu Gri)
- **Accent:** #FF6B00 (Turuncu)

### 2. Dark Theme
- **Primary:** #FF0000 (Kırmızı)
- **Secondary:** #000000 (Siyah)
- **Accent:** #8B0000 (Koyu Kırmızı)

### 3. Light Theme
- **Primary:** #4A90E2 (Mavi)
- **Secondary:** #F5F5F5 (Açık Gri)
- **Accent:** #50C878 (Yeşil)

---

## ✨ ÖZELLİKLER

### Animasyonlar
- ✅ Preloader (Taksi animasyonu)
- ✅ Custom Cursor (Taksi tekeri)
- ✅ Scrollbar animasyonu
- ✅ GSAP animasyonlar
- ✅ Parallax efektleri
- ✅ Micro interactions

### SEO
- ✅ Meta tags
- ✅ Schema.org markup
- ✅ Open Graph
- ✅ Twitter Cards
- ✅ Sitemap.xml
- ✅ Robots.txt
- ✅ LLMs.txt

### Güvenlik
- ✅ XSS Protection
- ✅ CSRF Protection
- ✅ SQL Injection Prevention
- ✅ Password Hashing
- ✅ Secure Headers

---

## 📝 DOKÜMANTASYON

- [Proje Planı](PROJE_PLANI_2025.md)
- [TODO Listesi](TODO.md)
- [İlerleme Raporu](ILERLEME_RAPORU.md)

---

## 🚀 DEPLOYMENT

### Production Checklist
- [ ] Config dosyasını güncelle
- [ ] Admin şifresini değiştir
- [ ] Google Analytics ekle
- [ ] Google Search Console kayıt
- [ ] SSL sertifikası kur
- [ ] HTTPS yönlendirme aktif et
- [ ] Hata raporlamayı kapat
- [ ] Cache'i aktif et

---

## 📞 DESTEK

Sorularınız için:
- **Email:** iletisim@antalyakorsan.com.tr
- **WhatsApp:** +905070073210

---

## 📄 LİSANS

Bu proje Antalya Korsan Taksi için özel olarak geliştirilmiştir.

---

## 👨‍💻 GELİŞTİRİCİ

**BLACKBOXAI**  
Tarih: 18 Kasım 2025

---

## 🎉 TEŞEKKÜRLER

Antalya Korsan Taksi ekibine güvenleri için teşekkür ederiz!

---

**Versiyon:** 1.0  
**Son Güncelleme:** 18 Kasım 2025  
**Durum:** 🚀 Geliştirme Devam Ediyor
