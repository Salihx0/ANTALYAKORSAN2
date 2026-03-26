<?php
/**
 * HAKKIMIZDA SAYFASI
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo.php';

// Sayfa bilgileri
$page_title = 'Hakkımızda - Antalya Korsan Taksi | Güvenilir Taksi Hizmeti';
$page_description = 'Antalya Korsan Taksi olarak 2010 yılından beri güvenilir, konforlu ve ekonomik taksi hizmeti sunuyoruz. Deneyimli ekibimiz ve modern araç filomuzla 7/24 hizmetinizdeyiz.';
$page_keywords = 'antalya korsan taksi hakkında, taksi şirketi, güvenilir taksi, profesyonel sürücü, antalya ulaşım';
$page_image = assets_url('images/about/team.jpg');
$body_class = 'about-page';

$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => site_url()],
    ['name' => 'Hakkımızda', 'url' => '']
];

include __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('<?php echo assets_url('images/headers/about-header.jpg'); ?>');">
        <div class="page-header-overlay"></div>
    </div>
    <div class="container">
        <div class="page-header-content" data-aos="fade-up">
            <h1 class="page-title">Hakkımızda</h1>
            <p class="page-subtitle">Antalya'nın En Güvenilir Taksi Hizmeti</p>
        </div>
    </div>
</section>

<!-- About Intro -->
<section class="about-intro section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="about-image">
                    <img src="<?php echo assets_url('images/about/company.jpg'); ?>" alt="Antalya Korsan Taksi" class="lazy">
                    <div class="about-badge">
                        <div class="badge-content">
                            <span class="badge-number">15+</span>
                            <span class="badge-text">Yıllık Tecrübe</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="about-content">
                    <span class="section-subtitle">Biz Kimiz?</span>
                    <h2 class="section-title">Antalya Korsan Taksi</h2>
                    <p class="lead">
                        2010 yılından bu yana Antalya'da güvenilir, konforlu ve ekonomik taksi hizmeti sunuyoruz.
                    </p>
                    <p>
                        Antalya Korsan Taksi olarak, müşteri memnuniyetini her şeyin üstünde tutarak, 
                        7/24 kesintisiz hizmet anlayışıyla çalışıyoruz. Deneyimli sürücü kadromuz, 
                        temiz ve bakımlı araç filomuz ile Antalya'nın her noktasına güvenli ulaşım sağlıyoruz.
                    </p>
                    <p>
                        Havalimanı transferinden şehir içi ulaşıma, turistik turlardan özel gün 
                        organizasyonlarına kadar geniş bir hizmet yelpazesi sunuyoruz. Müşterilerimizin 
                        güvenliği ve konforu bizim için en önemli önceliktir.
                    </p>
                    <div class="about-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Lisanslı ve Sigortalı</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Profesyonel Sürücüler</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Modern Araç Filosu</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>7/24 Hizmet</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="mission-vision section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="mission-card">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Misyonumuz</h3>
                    <p>
                        Antalya'da yaşayan ve ziyaret eden herkese güvenli, konforlu ve ekonomik 
                        ulaşım hizmeti sunarak, şehir içi mobiliteye katkıda bulunmak. Müşteri 
                        memnuniyetini ön planda tutarak, kaliteli hizmet anlayışını sürdürmek.
                    </p>
                    <ul class="mission-list">
                        <li><i class="fas fa-arrow-right"></i> Güvenli ve konforlu yolculuk</li>
                        <li><i class="fas fa-arrow-right"></i> Zamanında ve güvenilir hizmet</li>
                        <li><i class="fas fa-arrow-right"></i> Şeffaf ve adil fiyatlandırma</li>
                        <li><i class="fas fa-arrow-right"></i> Müşteri odaklı yaklaşım</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="vision-card">
                    <div class="card-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Vizyonumuz</h3>
                    <p>
                        Antalya'nın en tercih edilen, güvenilir ve kaliteli taksi hizmeti sağlayıcısı 
                        olmak. Teknolojik gelişmeleri takip ederek, hizmet kalitemizi sürekli 
                        geliştirmek ve sektörde öncü konumda olmak.
                    </p>
                    <ul class="vision-list">
                        <li><i class="fas fa-arrow-right"></i> Sektörde lider marka olmak</li>
                        <li><i class="fas fa-arrow-right"></i> Teknolojik altyapıyı güçlendirmek</li>
                        <li><i class="fas fa-arrow-right"></i> Hizmet ağını genişletmek</li>
                        <li><i class="fas fa-arrow-right"></i> Çevre dostu araçlara geçiş</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="values-section section-padding">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-subtitle">Değerlerimiz</span>
            <h2 class="section-title">Bizi Farklı Kılan Değerler</h2>
        </div>
        
        <div class="values-grid">
            <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                <div class="value-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Güvenilirlik</h3>
                <p>Müşterilerimizin güvenini kazanmak ve korumak en önemli önceliğimizdir.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                <div class="value-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3>Kalite</h3>
                <p>Her zaman en yüksek kalite standartlarında hizmet sunmayı hedefliyoruz.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                <div class="value-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3>Dürüstlük</h3>
                <p>Şeffaf ve dürüst iş anlayışı ile müşterilerimize hizmet veriyoruz.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="400">
                <div class="value-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Müşteri Odaklılık</h3>
                <p>Müşteri memnuniyeti bizim için her şeyin üstündedir.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="500">
                <div class="value-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Zamanında Hizmet</h3>
                <p>Zamanınıza değer veriyor, her zaman dakik olmaya özen gösteriyoruz.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="600">
                <div class="value-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3>Çevre Bilinci</h3>
                <p>Çevre dostu araçlar ve uygulamalarla sürdürülebilir hizmet sunuyoruz.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats-section section-padding bg-primary">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number counter" data-target="15" data-duration="2">0</span>
                    <span class="stat-suffix">+</span>
                    <span class="stat-label">Yıllık Tecrübe</span>
                </div>
            </div>
            
            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number counter" data-target="50000" data-duration="2">0</span>
                    <span class="stat-suffix">+</span>
                    <span class="stat-label">Mutlu Müşteri</span>
                </div>
            </div>
            
            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number counter" data-target="25" data-duration="2">0</span>
                    <span class="stat-suffix">+</span>
                    <span class="stat-label">Araç Filosu</span>
                </div>
            </div>
            
            <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-icon">
                    <i class="fas fa-route"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number counter" data-target="100000" data-duration="2">0</span>
                    <span class="stat-suffix">+</span>
                    <span class="stat-label">Tamamlanan Sefer</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="team-section section-padding">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-subtitle">Ekibimiz</span>
            <h2 class="section-title">Profesyonel Kadromuz</h2>
            <p class="section-description">
                Deneyimli ve güler yüzlü ekibimizle hizmetinizdeyiz
            </p>
        </div>
        
        <div class="team-grid">
            <div class="team-card" data-aos="fade-up" data-aos-delay="100">
                <div class="team-image">
                    <img src="<?php echo assets_url('images/team/driver-1.jpg'); ?>" alt="Sürücü" class="lazy">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-content">
                    <h3 class="team-name">Mehmet Yılmaz</h3>
                    <span class="team-position">Kıdemli Sürücü</span>
                    <p class="team-description">12 yıllık tecrübe ile güvenli yolculuk</p>
                </div>
            </div>
            
            <div class="team-card" data-aos="fade-up" data-aos-delay="200">
                <div class="team-image">
                    <img src="<?php echo assets_url('images/team/driver-2.jpg'); ?>" alt="Sürücü" class="lazy">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-content">
                    <h3 class="team-name">Ahmet Demir</h3>
                    <span class="team-position">Profesyonel Sürücü</span>
                    <p class="team-description">8 yıllık tecrübe ile konforlu hizmet</p>
                </div>
            </div>
            
            <div class="team-card" data-aos="fade-up" data-aos-delay="300">
                <div class="team-image">
                    <img src="<?php echo assets_url('images/team/driver-3.jpg'); ?>" alt="Sürücü" class="lazy">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-content">
                    <h3 class="team-name">Ali Kaya</h3>
                    <span class="team-position">Deneyimli Sürücü</span>
                    <p class="team-description">10 yıllık tecrübe ile güvenilir ulaşım</p>
                </div>
            </div>
            
            <div class="team-card" data-aos="fade-up" data-aos-delay="400">
                <div class="team-image">
                    <img src="<?php echo assets_url('images/team/driver-4.jpg'); ?>" alt="Sürücü" class="lazy">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-content">
                    <h3 class="team-name">Mustafa Öz</h3>
                    <span class="team-position">Profesyonel Sürücü</span>
                    <p class="team-description">9 yıllık tecrübe ile kaliteli hizmet</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section section-padding">
    <div class="cta-background">
        <div class="cta-overlay"></div>
    </div>
    
    <div class="container">
        <div class="cta-content text-center" data-aos="zoom-in">
            <h2 class="cta-title">Güvenli Yolculuk İçin Hemen Arayın!</h2>
            <p class="cta-description">
                7/24 hizmetinizdeyiz. WhatsApp üzerinden anında rezervasyon yapabilirsiniz.
            </p>
            <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode(WHATSAPP_MESSAGE); ?>" 
               class="btn btn-primary btn-lg btn-pulse" 
               target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp ile İletişime Geç</span>
            </a>
        </div>
    </div>
</section>

<!-- AOS Animation -->
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

<?php include __DIR__ . '/includes/footer.php'; ?>
