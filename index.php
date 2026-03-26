<?php
/**
 * ANA SAYFA
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

// Oturum başlat
session_start();

// Config ve fonksiyonları yükle
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo.php';

// Sayfa bilgileri - SEO Optimize (50-60 karakter başlık, 150-160 karakter açıklama)
$page_title = 'Antalya Korsan Taksi | 7/24 Havalimanı Transfer Hizmeti';
$page_description = 'Antalya\'da 7/24 güvenilir ve ucuz taksi hizmeti. Havalimanı transferi, şehir içi ulaşım, turistik turlar. Hemen WhatsApp\'dan rezervasyon yapın!';
$page_keywords = 'antalya korsan taksi, antalya taksi, havalimanı transfer antalya, antalya transfer, korsan taksi, taksi antalya, 7/24 taksi, güvenilir taksi, antalya ulaşım';
$page_image = assets_url('images/hero/hero-main.jpg');
$body_class = 'home-page';

// Breadcrumb
$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => site_url()]
];

// Header dahil et
include __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="hero-background">
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?php echo assets_url('videos/taxi-hero.mp4'); ?>" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
    </div>
    
    <div class="hero-content">
        <div class="container">
            <div class="hero-text" data-aos="fade-up">
                <h1 class="hero-title">
                    <span class="hero-title-main">Antalya Korsan Taksi</span>
                    <span class="hero-title-sub">7/24 Güvenilir Ulaşım Hizmeti</span>
                </h1>
                <p class="hero-description">
                    Havalimanı transferi, şehir içi ulaşım ve turistik turlar için profesyonel taksi hizmeti. 
                    Ekonomik fiyatlar, güvenli yolculuk, deneyimli sürücüler.
                </p>
                <div class="hero-buttons">
                    <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode(WHATSAPP_MESSAGE); ?>" 
                       class="btn btn-primary btn-lg" 
                       target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>Hemen Araç Çağır</span>
                    </a>
                    <a href="<?php echo site_url('hizmetler'); ?>" class="btn btn-outline btn-lg">
                        <i class="fas fa-info-circle"></i>
                        <span>Hizmetlerimiz</span>
                    </a>
                </div>
                <div class="hero-features">
                    <div class="hero-feature">
                        <i class="fas fa-clock"></i>
                        <span>7/24 Hizmet</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Güvenli Yolculuk</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Ekonomik Fiyat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="hero-scroll-indicator">
        <div class="scroll-mouse">
            <div class="scroll-wheel"></div>
        </div>
        <span>Aşağı Kaydır</span>
    </div>
</section>

<!-- Services Section -->
<section class="services-section section-padding" id="services">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-subtitle">Hizmetlerimiz</span>
            <h2 class="section-title">Neler Sunuyoruz?</h2>
            <p class="section-description">
                Antalya'da tüm ulaşım ihtiyaçlarınız için profesyonel taksi hizmetleri
            </p>
        </div>
        
        <div class="services-grid">
            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon">
                    <i class="fas fa-plane-departure"></i>
                </div>
                <h3 class="service-title">Havalimanı Transfer</h3>
                <p class="service-description">
                    Antalya Havalimanı'ndan şehir merkezine ve tüm bölgelere güvenli transfer hizmeti.
                </p>
                <a href="<?php echo site_url('hizmetler'); ?>" class="service-link">
                    Detaylı Bilgi <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="service-icon">
                    <i class="fas fa-city"></i>
                </div>
                <h3 class="service-title">Şehir İçi Ulaşım</h3>
                <p class="service-description">
                    Antalya şehir içinde her noktaya hızlı ve konforlu ulaşım imkanı.
                </p>
                <a href="<?php echo site_url('hizmetler'); ?>" class="service-link">
                    Detaylı Bilgi <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                <div class="service-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 class="service-title">Turistik Turlar</h3>
                <p class="service-description">
                    Antalya'nın turistik yerlerini gezmek için özel tur programları.
                </p>
                <a href="<?php echo site_url('hizmetler'); ?>" class="service-link">
                    Detaylı Bilgi <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                <div class="service-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="service-title">7/24 Hizmet</h3>
                <p class="service-description">
                    Gece gündüz demeden her an ulaşabileceğiniz kesintisiz hizmet.
                </p>
                <a href="<?php echo site_url('hizmetler'); ?>" class="service-link">
                    Detaylı Bilgi <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="service-card" data-aos="fade-up" data-aos-delay="500">
                <div class="service-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="service-title">Özel Gün Transferleri</h3>
                <p class="service-description">
                    Düğün, toplantı ve özel günleriniz için VIP transfer hizmeti.
                </p>
                <a href="<?php echo site_url('hizmetler'); ?>" class="service-link">
                    Detaylı Bilgi <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="service-card" data-aos="fade-up" data-aos-delay="600">
                <div class="service-icon">
                    <i class="fas fa-route"></i>
                </div>
                <h3 class="service-title">Bölgesel Transfer</h3>
                <p class="service-description">
                    Antalya ilçeleri ve çevre illere güvenli transfer hizmeti.
                </p>
                <a href="<?php echo site_url('hizmetler'); ?>" class="service-link">
                    Detaylı Bilgi <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-us-section section-padding bg-light" id="why-us">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-subtitle">Neden Biz?</span>
            <h2 class="section-title">Antalya Korsan Taksi'yi Tercih Etme Nedenleri</h2>
        </div>
        
        <div class="why-us-content">
            <div class="why-us-image" data-aos="fade-right">
                <img src="<?php echo assets_url('images/why-us/taxi-driver.jpg'); ?>" alt="Profesyonel Taksi Hizmeti" class="lazy">
            </div>
            
            <div class="why-us-features" data-aos="fade-left">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Profesyonel Sürücüler</h3>
                        <p>Deneyimli ve güler yüzlü sürücülerimizle güvenli yolculuk</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Temiz ve Konforlu Araçlar</h3>
                        <p>Düzenli bakımlı, temiz ve konforlu araç filomuz</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Uygun Fiyatlar</h3>
                        <p>Şeffaf ve rekabetçi fiyatlarla ekonomik ulaşım</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h3>7/24 Müşteri Desteği</h3>
                        <p>Her an ulaşabileceğiniz müşteri hizmetleri</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Güvenli Yolculuk</h3>
                        <p>Sigortalı araçlar ve güvenli sürüş garantisi</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Hızlı Hizmet</h3>
                        <p>Anında rezervasyon ve hızlı ulaşım</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section section-padding" id="cta">
    <div class="cta-background">
        <div class="cta-overlay"></div>
    </div>
    
    <div class="container">
        <div class="cta-content text-center" data-aos="zoom-in">
            <h2 class="cta-title">Hemen Araç Çağırın!</h2>
            <p class="cta-description">
                WhatsApp üzerinden anında rezervasyon yapın, konforlu yolculuğunuz başlasın.
            </p>
            <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode(WHATSAPP_MESSAGE); ?>" 
               class="btn btn-primary btn-lg btn-pulse" 
               target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp ile Araç Çağır</span>
            </a>
            <div class="cta-info">
                <i class="fas fa-phone"></i>
                <span>Veya Arayın: <a href="tel:<?php echo CONTACT_PHONE; ?>"><?php echo CONTACT_PHONE; ?></a></span>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section section-padding" id="blog">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-subtitle">Blog</span>
            <h2 class="section-title">Son Yazılarımız</h2>
            <p class="section-description">
                Antalya ulaşımı ve taksi hizmetleri hakkında faydalı bilgiler
            </p>
        </div>
        
        <div class="blog-grid">
            <?php
            // Son 3 makaleyi getir
            try {
                $articles = get_articles(3, 0);
                
                if (!empty($articles)) {
                    $delay = 100;
                    foreach ($articles as $article) {
                        ?>
                        <article class="blog-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                            <div class="blog-image">
                                <img src="<?php echo $article['featured_image'] ?? assets_url('images/blog/placeholder.jpg'); ?>" 
                                     alt="<?php echo htmlspecialchars($article['title']); ?>" 
                                     class="lazy">
                                <div class="blog-category"><?php echo htmlspecialchars($article['category_name'] ?? 'Genel'); ?></div>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-date">
                                        <i class="fas fa-calendar"></i>
                                        <?php echo format_date($article['published_at']); ?>
                                    </span>
                                    <span class="blog-reading-time">
                                        <i class="fas fa-clock"></i>
                                        <?php echo reading_time($article['content']); ?> dk
                                    </span>
                                </div>
                                <h3 class="blog-title">
                                    <a href="<?php echo site_url('blog/' . $article['slug']); ?>">
                                        <?php echo htmlspecialchars($article['title']); ?>
                                    </a>
                                </h3>
                                <p class="blog-excerpt">
                                    <?php echo create_excerpt($article['content'], 150); ?>
                                </p>
                                <a href="<?php echo site_url('blog/' . $article['slug']); ?>" class="blog-link">
                                    Devamını Oku <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                        <?php
                        $delay += 100;
                    }
                } else {
                    // Placeholder makaleler
                    for ($i = 1; $i <= 3; $i++) {
                        ?>
                        <article class="blog-card" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">
                            <div class="blog-image">
                                <img src="<?php echo assets_url('images/blog/placeholder-' . $i . '.jpg'); ?>" 
                                     alt="Blog Yazısı <?php echo $i; ?>" 
                                     class="lazy">
                                <div class="blog-category">Antalya Taksi</div>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-date">
                                        <i class="fas fa-calendar"></i>
                                        <?php echo date('d.m.Y'); ?>
                                    </span>
                                    <span class="blog-reading-time">
                                        <i class="fas fa-clock"></i>
                                        5 dk
                                    </span>
                                </div>
                                <h3 class="blog-title">
                                    <a href="<?php echo site_url('blog'); ?>">
                                        Antalya Korsan Taksi Hizmetleri Hakkında
                                    </a>
                                </h3>
                                <p class="blog-excerpt">
                                    Antalya'da güvenilir ve ekonomik taksi hizmeti almak için bilmeniz gerekenler...
                                </p>
                                <a href="<?php echo site_url('blog'); ?>" class="blog-link">
                                    Devamını Oku <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                        <?php
                    }
                }
            } catch (Exception $e) {
                // Hata durumunda placeholder göster
                echo '<!-- Blog yükleme hatası: ' . $e->getMessage() . ' -->';
            }
            ?>
        </div>
        
        <div class="text-center" data-aos="fade-up">
            <a href="<?php echo site_url('blog'); ?>" class="btn btn-outline btn-lg">
                <span>Tüm Yazıları Gör</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });
</script>

<?php
// Footer dahil et
include __DIR__ . '/includes/footer.php';
?>
