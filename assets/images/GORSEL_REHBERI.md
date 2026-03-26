# GÖRSEL REHBERİ
Antalya Korsan Taksi - Görsel Gereksinimleri

## 📋 GEREKLİ GÖRSELLER

### 1. LOGO
**Dosya:** `logo.png`, `logo.svg`
**Boyut:** 200x60px (header için)
**Format:** PNG (transparan), SVG (vektör)
**Renk:** Beyaz (dark bg için), Mavi (light bg için)

**Tasarım Önerileri:**
- Taksi ikonu + "Antalya Korsan Taksi" yazısı
- Modern, minimal tasarım
- Okunabilir font
- Mavi-turuncu renk paleti

### 2. FAVICON
**Dosya:** `favicon.ico`, `favicon-16x16.png`, `favicon-32x32.png`
**Boyut:** 16x16, 32x32, 48x48px
**Format:** ICO, PNG

**Tasarım:**
- Basit taksi ikonu
- Mavi-turuncu gradient
- Minimal detay

### 3. HERO SECTION
**Dosya:** `hero-bg.jpg`
**Boyut:** 1920x1080px
**Format:** JPG (optimize)
**Boyut Limiti:** Max 300KB

**İçerik:**
- Antalya manzarası
- Taksi veya araç görseli
- Profesyonel fotoğraf
- Blur efekti uygulanabilir

### 4. HİZMETLER İKONLARI
**Dosyalar:** 
- `service-airport.svg`
- `service-city.svg`
- `service-intercity.svg`
- `service-hourly.svg`
- `service-tour.svg`
- `service-corporate.svg`

**Boyut:** 64x64px
**Format:** SVG
**Stil:** Line icons, minimal

### 5. BLOG GÖRSELLERİ
**Klasör:** `blog/`
**Dosyalar:** `blog-1.jpg` - `blog-15.jpg`
**Boyut:** 800x450px (16:9)
**Format:** JPG (optimize)
**Boyut Limiti:** Max 150KB/görsel

**Konular:**
1. Antalya Havalimanı
2. Antalya şehir merkezi
3. Lara plajı
4. Kaleiçi
5. Konyaaltı
6. Taksi içi
7. Profesyonel sürücü
8. Temiz araç
9. Gece Antalya
10. Turistik yerler
11. Transfer hizmeti
12. Havalimanı karşılama
13. Konforlu yolculuk
14. Güvenli sürüş
15. Müşteri memnuniyeti

### 6. HAKKIMIZDA
**Dosya:** `about-us.jpg`
**Boyut:** 1200x800px
**Format:** JPG
**İçerik:** Ekip fotoğrafı, araç filosu

### 7. İLETİŞİM
**Dosya:** `contact-map.jpg`
**Boyut:** 1200x600px
**Format:** JPG
**İçerik:** Antalya haritası, ofis

### 8. SOSYAL MEDYA
**Dosyalar:**
- `og-image.jpg` (1200x630px) - Facebook/LinkedIn
- `twitter-card.jpg` (1200x600px) - Twitter

## 🎨 RENK PALETİ

### Primary Colors
- **Mavi:** #007BFF
- **Turuncu:** #FFA500
- **Beyaz:** #FFFFFF

### Secondary Colors
- **Koyu Gri:** #2D3748
- **Açık Gri:** #F7FAFC
- **Yeşil:** #43E97B (success)
- **Kırmızı:** #F5576C (danger)

## 📐 BOYUT REHBERİ

### Desktop
- Hero: 1920x1080px
- Blog: 800x450px
- Thumbnail: 400x225px

### Mobile
- Hero: 768x1024px
- Blog: 600x338px
- Thumbnail: 300x169px

### Icons
- Small: 24x24px
- Medium: 48x48px
- Large: 64x64px

## 🔧 OPTİMİZASYON

### JPG
- Kalite: 80-85%
- Progressive: Evet
- Max boyut: 300KB (hero), 150KB (blog)

### PNG
- Compression: TinyPNG
- Transparan: Evet
- Max boyut: 100KB

### SVG
- Minify: Evet
- Inline kullanım: Evet
- Max boyut: 10KB

## 📱 RESPONSIVE

### Breakpoints
- Mobile: 320px - 767px
- Tablet: 768px - 1024px
- Desktop: 1025px+

### Görsel Boyutları
```css
/* Mobile */
@media (max-width: 767px) {
  .hero-bg { background-size: cover; }
  .blog-img { max-width: 100%; }
}

/* Tablet */
@media (min-width: 768px) and (max-width: 1024px) {
  .hero-bg { background-size: cover; }
  .blog-img { max-width: 600px; }
}

/* Desktop */
@media (min-width: 1025px) {
  .hero-bg { background-size: cover; }
  .blog-img { max-width: 800px; }
}
```

## 🌐 ALTERNATİF KAYNAKLAR

### Ücretsiz Stok Fotoğraf
- Unsplash.com
- Pexels.com
- Pixabay.com

### İkon Kütüphaneleri
- Font Awesome (kullanılıyor)
- Heroicons
- Feather Icons

### Görsel Optimizasyon
- TinyPNG.com
- Squoosh.app
- ImageOptim

## 📝 PLACEHOLDER KULLANIMI

Geliştirme aşamasında placeholder kullanımı:

```html
<!-- Hero -->
<img src="https://via.placeholder.com/1920x1080/007BFF/FFFFFF?text=Hero+Image" alt="Hero">

<!-- Blog -->
<img src="https://via.placeholder.com/800x450/007BFF/FFFFFF?text=Blog+Image" alt="Blog">

<!-- Icon -->
<img src="https://via.placeholder.com/64x64/007BFF/FFFFFF?text=Icon" alt="Icon">
```

## ✅ KONTROL LİSTESİ

- [ ] Logo (PNG + SVG)
- [ ] Favicon (ICO + PNG)
- [ ] Hero background
- [ ] 6 hizmet ikonu
- [ ] 15 blog görseli
- [ ] Hakkımızda görseli
- [ ] İletişim görseli
- [ ] OG image
- [ ] Twitter card
- [ ] Tüm görseller optimize
- [ ] Alt text eklendi
- [ ] Lazy loading aktif
- [ ] WebP format desteği

## 🚀 UYGULAMA

### 1. Görselleri İndir/Oluştur
```bash
# Klasör yapısı
assets/images/
├── logo.png
├── logo.svg
├── favicon.ico
├── hero-bg.jpg
├── about-us.jpg
├── contact-map.jpg
├── og-image.jpg
├── twitter-card.jpg
├── services/
│   ├── airport.svg
│   ├── city.svg
│   ├── intercity.svg
│   ├── hourly.svg
│   ├── tour.svg
│   └── corporate.svg
└── blog/
    ├── blog-1.jpg
    ├── blog-2.jpg
    └── ... (15 adet)
```

### 2. HTML'de Kullanım
```html
<!-- Logo -->
<img src="assets/images/logo.png" alt="Antalya Korsan Taksi" width="200" height="60">

<!-- Hero -->
<section class="hero" style="background-image: url('assets/images/hero-bg.jpg')">

<!-- Blog -->
<img src="assets/images/blog/blog-1.jpg" alt="Blog başlığı" loading="lazy">

<!-- Icon -->
<img src="assets/images/services/airport.svg" alt="Havalimanı" width="64" height="64">
```

### 3. CSS'de Kullanım
```css
.hero-section {
  background-image: url('../images/hero-bg.jpg');
  background-size: cover;
  background-position: center;
}

.service-icon {
  width: 64px;
  height: 64px;
  background-size: contain;
}
```

## 📞 DESTEK

Görsel tasarım desteği için:
- Fiverr.com (logo tasarımı)
- 99designs.com (profesyonel tasarım)
- Canva.com (DIY tasarım)

---

**Not:** Tüm görseller telif hakkı açısından güvenli olmalıdır. Ticari kullanım için lisans kontrolü yapılmalıdır.
