<?php
/**
 * HİZMETLER SAYFASI
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
$page_title = 'Hizmetlerimiz - Antalya Korsan Taksi | Havalimanı Transfer, Şehir İçi Ulaşım';
$page_description = 'Antalya Korsan Taksi hizmetleri: Havalimanı transferi, şehir içi ulaşım, turistik turlar, özel gün transferleri, bölgesel transfer ve 7/24 taksi hizmeti. Ekonomik fiyatlar, güvenli yolculuk.';
$page_keywords = 'antalya taksi hizmetleri, havalimanı transfer, şehir içi ulaşım, turistik tur, özel transfer, 7/24 taksi';
$page_image = assets_url('images/services/services-main.jpg');
$body_class = 'services-page';

$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => site_url()],
    ['name' => 'Hizmetlerimiz', 'url' => '']
];

include __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('<?php echo assets_url('images/headers/services-header.jpg'); ?>');">
        <div class="page-header-overlay"></div>
    </div>
    <div class="container">
        <div class="page-header-content" data-aos="fade-up">
            <h1 class="page-title">Hizmetlerimiz</h1>
            <p class="page-subtitle">Tüm Ulaşım İhtiyaçlarınız İçin Profesyonel Çözümler</p>
        </div>
    </div>
</section>

<!-- Services Intro -->
<section class="services-intro section-padding">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-subtitle">Neler Sunuyoruz?</span>
            <h2 class="section-title">Kapsamlı Taksi Hizmetleri</h2>
            <p class="section-description">
                Antalya'da tüm ulaşım ihtiyaçlarınız için 7/24 profesyonel taksi hizmeti
            </p>
        </div>
    </div>
</section>

<!-- Main Services -->
<section class="main-services section-padding bg-light">
    <div class="container">
        <!-- Havalimanı Transfer -->
        <div class="service-detail" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="service-image">
                        <img src="<?php echo assets_url('images/services/airport-transfer.jpg'); ?>" alt="Havalimanı Transfer" class="lazy">
                        <div class="service-badge">
                            <i class="fas fa-plane-departure"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-content">
                        <h2 class="service-title">Havalimanı Transfer</h2>
                        <p class="service-description">
                            Antalya Havalimanı'ndan şehir merkezine ve tüm bölgelere güvenli, konforlu 
                            ve zamanında transfer hizmeti sunuyoruz. Uçuş saatinize göre planlama yapıyor, 
                            sizi havalimanında karşılıyor ve güvenle hedefinize ulaştırıyoruz.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> Uçuş takibi ve zamanında karşılama</li>
                            <li><i class="fas fa-check"></i> Bagaj yardımı</li>
                            <li><i class="fas fa-check"></i> Klimalı ve konforlu araçlar</li>
                            <li><i class="fas fa-check"></i> Profesyonel sürücüler</li>
                            <li><i class="fas fa-check"></i> Sabit fiyat garantisi</li>
                            <li><i class="fas fa-check"></i> 7/24 hizmet</li>
                        </ul>
                        <div class="service-price">
                            <span class="price-label">Başlangıç Fiyatı:</span>
                            <span class="price-amount">150 TL'den itibaren</span>
                        </div>
                        <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode('Havalimanı transfer hizmeti hakkında bilgi almak istiyorum.'); ?>" 
                           class="btn btn-primary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>Rezervasyon Yap</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Şehir İçi Ulaşım -->
        <div class="service-detail" data-aos="fade-up">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6">
                    <div class="service-image">
                        <img src="<?php echo assets_url('images/services/city-transport.jpg'); ?>" alt="Şehir İçi Ulaşım" class="lazy">
                        <div class="service-badge">
                            <i class="fas fa-city"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-content">
                        <h2 class="service-title">Şehir İçi Ulaşım</h2>
                        <p class="service-description">
                            Antalya şehir içinde her noktaya hızlı, güvenli ve konforlu ulaşım imkanı. 
                            İş toplantılarınız, alışveriş, hastane ziyaretleri veya sosyal aktiviteleriniz 
                            için güvenilir taksi hizmeti.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> Antalya'nın her noktasına ulaşım</li>
                            <li><i class="fas fa-check"></i> Hızlı ve güvenli sürüş</li>
                            <li><i class="fas fa-check"></i> Temiz ve bakımlı araçlar</li>
                            <li><i class="fas fa-check"></i> Güler yüzlü sürücüler</li>
                            <li><i class="fas fa-check"></i> Uygun fiyatlar</li>
                            <li><i class="fas fa-check"></i> Anında hizmet</li>
                        </ul>
                        <div class="service-price">
                            <span class="price-label">Başlangıç Fiyatı:</span>
                            <span class="price-amount">50 TL'den itibaren</span>
                        </div>
                        <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode('Şehir içi ulaşım hizmeti hakkında bilgi almak istiyorum.'); ?>" 
                           class="btn btn-primary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>Araç Çağır</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Turistik Turlar -->
        <div class="service-detail" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="service-image">
                        <img src="<?php echo assets_url('images/services/tourist-tours.jpg'); ?>" alt="Turistik Turlar" class="lazy">
                        <div class="service-badge">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-content">
                        <h2 class="service-title">Turistik Turlar</h2>
                        <p class="service-description">
                            Antalya'nın tarihi ve turistik yerlerini gezmek için özel tur programları. 
                            Deneyimli rehber sürücülerimiz eşliğinde Antalya'yı keşfedin. Kendi 
                            programınızı oluşturabilir veya hazır turlarımızdan birini seçebilirsiniz.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> Kaleiçi, Düden Şelalesi, Konyaaltı</li>
                            <li><i class="fas fa-check"></i> Perge, Aspendos, Side antik kentleri</li>
                            <li><i class="fas fa-check"></i> Kemer, Olimpos, Çıralı</li>
                            <li><i class="fas fa-check"></i> Özel tur programları</li>
                            <li><i class="fas fa-check"></i> Rehber sürücü hizmeti</li>
                            <li><i class="fas fa-check"></i> Fotoğraf molası imkanı</li>
                        </ul>
                        <div class="service-price">
                            <span class="price-label">Başlangıç Fiyatı:</span>
                            <span class="price-amount">300 TL'den itibaren</span>
                        </div>
                        <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode('Turistik tur hizmeti hakkında bilgi almak istiyorum.'); ?>" 
                           class="btn btn-primary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>Tur Planla</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Özel Gün Transferleri -->
        <div class="service-detail" data-aos="fade-up">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6">
                    <div class="service-image">
                        <img src="<?php echo assets_url('images/services/special-events.jpg'); ?>" alt="Özel Gün Transferleri" class="lazy">
                        <div class="service-badge">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-content">
                        <h2 class="service-title">Özel Gün Transferleri</h2>
                        <p class="service-description">
                            Düğün, nişan, doğum günü, toplantı ve diğer özel günleriniz için VIP 
                            transfer hizmeti. Özel günlerinizi daha da özel kılmak için lüks araçlar 
                            ve profesyonel hizmet sunuyoruz.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> Düğün ve nişan transferleri</li>
                            <li><i class="fas fa-check"></i> Doğum günü organizasyonları</li>
                            <li><i class="fas fa-check"></i> İş toplantıları</li>
                            <li><i class="fas fa-check"></i> VIP araç seçenekleri</li>
                            <li><i class="fas fa-check"></i> Özel süsleme hizmeti</li>
                            <li><i class="fas fa-check"></i> Profesyonel şoför</li>
                        </ul>
                        <div class="service-price">
                            <span class="price-label">Başlangıç Fiyatı:</span>
                            <span class="price-amount">500 TL'den itibaren</span>
                        </div>
                        <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode('Özel gün transfer hizmeti hakkında bilgi almak istiyorum.'); ?>" 
                           class="btn btn-primary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>Teklif Al</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bölgesel Transfer -->
        <div class="service-detail" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="service-image">
                        <img src="<?php echo assets_url('images/services/regional-transfer.jpg'); ?>" alt="Bölgesel Transfer" class="lazy">
                        <div class="service-badge">
                            <i class="fas fa-route"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-content">
                        <h2 class="service-title">Bölgesel Transfer</h2>
                        <p class="service-description">
                            Antalya ilçeleri (Kemer, Belek, Side, Alanya, Kaş, Kalkan) ve çevre illere 
                            (Isparta, Burdur, Konya) güvenli ve konforlu transfer hizmeti. Uzun yolculuklarınız 
                            için ideal çözüm.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> Antalya ilçelerine transfer</li>
                            <li><i class="fas fa-check"></i> Çevre illere ulaşım</li>
                            <li><i class="fas fa-check"></i> Konforlu uzun yol araçları</li>
                            <li><i class="fas fa-check"></i> Deneyimli sürücüler</li>
                            <li><i class="fas fa-check"></i> Mola imkanı</li>
                            <li><i class="fas fa-check"></i> Sabit fiyat garantisi</li>
                        </ul>
                        <div class="service-price">
                            <span class="price-label">Başlangıç Fiyatı:</span>
                            <span class="price-amount">200 TL'den itibaren</span>
                        </div>
                        <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode('Bölgesel transfer hizmeti hakkında bilgi almak istiyorum.'); ?>" 
                           class="btn btn-primary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>Rezervasyon Yap</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 7/24 Hizmet -->
        <div class="service-detail" data-aos="fade-up">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6">
                    <div class="service-image">
                        <img src="<?php echo assets_url('images/services/24-7-service.jpg'); ?>" alt="7/24 Hizmet" class="lazy">
                        <div class="service-badge">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-content">
                        <h2 class="service-title">7/24 Kesintisiz Hizmet</h2>
                        <p class="service-description">
                            Gece gündüz demeden her an ulaşabileceğiniz kesintisiz taksi hizmeti. 
                            Acil durumlarınızda, gece geç saatlerde veya erken sabah saatlerinde 
                            güvenle ulaşabileceğiniz profesyonel hizmet.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> 24 saat kesintisiz hizmet</li>
                            <li><i class="fas fa-check"></i> Gece tarifesi yok</li>
                            <li><i class="fas fa-check"></i> Acil durum hizmeti</li>
                            <li><i class="fas fa-check"></i> Anında ulaşım</li>
                            <li><i class="fas fa-check"></i> Güvenli gece yolculuğu</li>
                            <li><i class="fas fa-check"></i> WhatsApp ile hızlı iletişim</li>
                        </ul>
                        <div class="service-price">
                            <span class="price-label">Başlangıç Fiyatı:</span>
                            <span class="price-amount">50 TL'den itibaren</span>
                        </div>
                        <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode('Araç çağırmak istiyorum.'); ?>" 
                           class="btn btn-primary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>Hemen Ara</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose section-padding">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-subtitle">Neden Bizi Tercih Etmelisiniz?</span>
            <h2 class="section-title">Avantajlarımız</h2>
        </div>
        
        <div class="advantages-grid">
            <div class="advantage-card" data-aos="fade-up" data-aos-delay="100">
                <div class="advantage-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Güvenli Yolculuk</h3>
                <p>Sigortalı araçlar ve deneyimli sürücülerle güvenli yolculuk garantisi</p>
            </div>
            
            <div class="advantage-card" data-aos="fade-up" data-aos-delay="200">
                <div class="advantage-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3>Uygun Fiyatlar</h3>
                <p>Şeffaf ve rekabetçi fiyatlarla ekonomik ulaşım hizmeti</p>
            </div>
            
            <div class="advantage-card" data-aos="fade-up" data-aos-delay="300">
                <div class="advantage-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>Profesyonel Ekip</h3>
                <p>Deneyimli ve güler yüzlü sürücü kadromuz</p>
            </div>
            
            <div class="advantage-card" data-aos="fade-up" data-aos-delay="400">
                <div class="advantage-icon">
                    <i class="fas fa-car"></i>
                </div>
                <h3>Temiz Araçlar</h3>
                <p>Düzenli bakımlı, temiz ve konforlu araç filomuz</p>
            </div>
            
            <div class="advantage-card" data-aos="fade-up" data-aos-delay="500">
                <div class="advantage-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Zamanında Hizmet</h3>
                <p>Dakik ve güvenilir hizmet anlayışı</p>
            </div>
            
            <div class="advantage-card" data-aos="fade-up" data-aos-delay="600">
                <div class="advantage-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>7/24 Destek</h3>
                <p>Her an ulaşabileceğiniz müşteri hizmetleri</p>
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
            <h2 class="cta-title">Hemen Rezervasyon Yapın!</h2>
            <p class="cta-description">
                WhatsApp üzerinden anında rezervasyon yapın, konforlu yolculuğunuz başlasın.
            </p>
            <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode(WHATSAPP_MESSAGE); ?>" 
               class="btn btn-primary btn-lg btn-pulse" 
               target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp ile Rezervasyon</span>
            </a>
            <div class="cta-info">
                <i class="fas fa-phone"></i>
                <span>Veya Arayın: <a href="tel:<?php echo CONTACT_PHONE; ?>"><?php echo CONTACT_PHONE; ?></a></span>
            </div>
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
