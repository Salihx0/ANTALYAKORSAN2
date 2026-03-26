<?php
/**
 * İLETİŞİM SAYFASI
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo.php';

$page_title = 'İletişim - Antalya Korsan Taksi | 7/24 Ulaşın';
$page_description = 'Antalya Korsan Taksi ile iletişime geçin. Telefon, WhatsApp, email veya iletişim formu ile 7/24 bize ulaşabilirsiniz.';
$page_keywords = 'antalya taksi iletişim, taksi çağır, whatsapp taksi, antalya taksi telefon';
$page_image = assets_url('images/contact/contact-main.jpg');
$body_class = 'contact-page';

$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => site_url()],
    ['name' => 'İletişim', 'url' => '']
];

// Form gönderimi
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = sanitize_input($_POST['name'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $phone = sanitize_input($_POST['phone'] ?? '');
    $subject = sanitize_input($_POST['subject'] ?? '');
    $message = sanitize_input($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Lütfen tüm zorunlu alanları doldurun.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Geçerli bir email adresi girin.';
    } else {
        try {
            save_contact_message($name, $email, $phone, $subject, $message);
            $success = true;
        } catch (Exception $e) {
            $error = 'Mesajınız gönderilemedi. Lütfen tekrar deneyin.';
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('<?php echo assets_url('images/headers/contact-header.jpg'); ?>');">
        <div class="page-header-overlay"></div>
    </div>
    <div class="container">
        <div class="page-header-content" data-aos="fade-up">
            <h1 class="page-title">İletişim</h1>
            <p class="page-subtitle">7/24 Size Ulaşmak İçin Buradayız</p>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="contact-info section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Telefon</h3>
                    <p><a href="tel:<?php echo CONTACT_PHONE; ?>"><?php echo CONTACT_PHONE; ?></a></p>
                    <span class="info-label">7/24 Arayın</span>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h3>WhatsApp</h3>
                    <p><a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>" target="_blank"><?php echo CONTACT_WHATSAPP; ?></a></p>
                    <span class="info-label">Hızlı İletişim</span>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p><a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a></p>
                    <span class="info-label">Mesaj Gönderin</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Map -->
<section class="contact-section section-padding bg-light">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="contact-form-wrapper">
                    <h2 class="section-title">Mesaj Gönderin</h2>
                    <p class="section-description">Sorularınız için formu doldurun, en kısa sürede size dönüş yapalım.</p>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post" class="contact-form">
                        <div class="form-group">
                            <label for="name">Adınız Soyadınız *</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Adresiniz *</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefon Numaranız</label>
                            <input type="tel" id="phone" name="phone" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Konu</label>
                            <select id="subject" name="subject" class="form-control">
                                <option value="">Seçiniz</option>
                                <option value="Havalimanı Transfer">Havalimanı Transfer</option>
                                <option value="Şehir İçi Ulaşım">Şehir İçi Ulaşım</option>
                                <option value="Turistik Tur">Turistik Tur</option>
                                <option value="Özel Gün">Özel Gün Transferi</option>
                                <option value="Diğer">Diğer</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mesajınız *</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" name="contact_submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i>
                            <span>Mesaj Gönder</span>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Map & Info -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="map-wrapper">
                    <h2 class="section-title">Konum</h2>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d202428.0!2d30.7!3d36.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14c39aaeddadadad%3A0x0!2sAntalya!5e0!3m2!1str!2str!4v1234567890" 
                                width="100%" 
                                height="400" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"></iframe>
                    </div>
                    
                    <div class="additional-info">
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Adres</h4>
                                <p><?php echo CONTACT_ADDRESS; ?></p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Çalışma Saatleri</h4>
                                <p>7/24 Hizmet</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i class="fab fa-instagram"></i>
                            <div>
                                <h4>Sosyal Medya</h4>
                                <p><a href="https://instagram.com/antalyaktaksi" target="_blank">@antalyaktaksi</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section section-padding">
    <div class="container">
        <div class="cta-content text-center" data-aos="zoom-in">
            <h2 class="cta-title">Hemen Araç Çağırın!</h2>
            <p class="cta-description">WhatsApp üzerinden anında rezervasyon yapın</p>
            <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode(WHATSAPP_MESSAGE); ?>" 
               class="btn btn-primary btn-lg btn-pulse" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp ile Ara</span>
            </a>
        </div>
    </div>
</section>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:800,once:true});</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
