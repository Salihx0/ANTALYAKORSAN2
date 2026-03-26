<?php
/**
 * FİYATLAR SAYFASI - YENİ FİYATLANDIRMA SİSTEMİ
 * 
 * @package AntalyaKorsanTaksi
 * @version 2.0
 * @date 18 Kasım 2025
 */

session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo.php';

$page_title = 'Fiyatlar - Antalya Korsan Taksi | İndirimli Taksi Ücretleri';
$page_description = 'Antalya Korsan Taksi fiyat listesi. 0-6km 150 TL, uzun mesafelerde indirimli fiyatlar! 50km+ Premium araç avantajı. Nakit, IBAN, Kredi Kartı ile ödeme.';
$page_keywords = 'antalya taksi fiyatları, indirimli taksi, havalimanı transfer ücreti, km başı fiyat';
$page_image = assets_url('images/pricing/pricing-main.jpg');
$body_class = 'pricing-page';

$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => site_url()],
    ['name' => 'Fiyatlar', 'url' => '']
];

include __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('<?php echo assets_url('images/headers/pricing-header.jpg'); ?>');">
        <div class="page-header-overlay"></div>
    </div>
    <div class="container">
        <div class="page-header-content" data-aos="fade-up">
            <h1 class="page-title">Fiyatlarımız</h1>
            <p class="page-subtitle">Uzun Mesafelerde İndirimli Fiyatlar!</p>
        </div>
    </div>
</section>

<!-- Pricing Info -->
<section class="pricing-info section-padding">
    <div class="container">
        <div class="pricing-highlights">
            <div class="row">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-highlight">
                        <div class="highlight-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Kısa Mesafe</h3>
                        <div class="highlight-price">
                            <span class="price">150</span>
                            <span class="currency">TL</span>
                        </div>
                        <p class="distance">0-6 km</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-highlight">
                        <div class="highlight-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <h3>Orta Mesafe</h3>
                        <div class="highlight-price">
                            <span class="price">25</span>
                            <span class="currency">TL/km</span>
                        </div>
                        <p class="distance">7-49 km</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="pricing-highlight discount">
                        <div class="discount-badge">%4 İndirim</div>
                        <div class="highlight-icon">
                            <i class="fas fa-road"></i>
                        </div>
                        <h3>Uzun Mesafe</h3>
                        <div class="highlight-price">
                            <span class="old-price">25 TL</span>
                            <span class="price">24</span>
                            <span class="currency">TL/km</span>
                        </div>
                        <p class="distance">50-74 km</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="pricing-highlight discount featured">
                        <div class="discount-badge">%16 İndirim</div>
                        <div class="highlight-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Çok Uzun</h3>
                        <div class="highlight-price">
                            <span class="old-price">25 TL</span>
                            <span class="price">21</span>
                            <span class="currency">TL/km</span>
                        </div>
                        <p class="distance">100+ km</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="premium-info" data-aos="fade-up">
            <div class="premium-banner">
                <div class="premium-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="premium-content">
                    <h3>⭐ PREMIUM ARAÇ AVANTAJI</h3>
                    <p><strong>50 KM ve üzeri yolculuklarda</strong> aynı fiyata premium araçlarımızla seyahat edin!</p>
                    <div class="premium-cars">
                        <span class="car-badge">🚗 2025 BYD ATTO 3</span>
                        <span class="car-badge">🚗 2024 TORRES EVX</span>
                        <span class="car-badge">🚗 AUDİ A3</span>
                    </div>
                    <p class="premium-note">Rezervasyonlu işlerde PREMIUM araç talep edilebilir!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Pricing -->
<section class="detailed-pricing section-padding bg-light">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Detaylı Fiyat Listesi</h2>
            <p class="section-description">Popüler güzergahlar ve indirimli fiyatlar</p>
        </div>
        
        <div class="pricing-table" data-aos="fade-up">
            <table class="table">
                <thead>
                    <tr>
                        <th>Güzergah</th>
                        <th>Mesafe</th>
                        <th>Normal Fiyat</th>
                        <th>İndirimli Fiyat</th>
                        <th>Tasarruf</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="highlight-row">
                        <td><strong>Kısa Mesafe (0-6 km)</strong></td>
                        <td>0-6 km</td>
                        <td colspan="3" class="text-center"><strong>150 TL (Sabit)</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Havalimanı - Kaleiçi</strong></td>
                        <td>13 km</td>
                        <td>325 TL</td>
                        <td><strong>325 TL</strong></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><strong>Havalimanı - Lara</strong></td>
                        <td>12 km</td>
                        <td>300 TL</td>
                        <td><strong>300 TL</strong></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><strong>Havalimanı - Konyaaltı</strong></td>
                        <td>15 km</td>
                        <td>375 TL</td>
                        <td><strong>375 TL</strong></td>
                        <td>-</td>
                    </tr>
                    <tr class="discount-row">
                        <td><strong>Havalimanı - Belek</strong></td>
                        <td>50 km</td>
                        <td><del>1.250 TL</del></td>
                        <td><strong>1.200 TL</strong> ⭐</td>
                        <td class="save">50 TL</td>
                    </tr>
                    <tr class="discount-row">
                        <td><strong>Havalimanı - Side</strong></td>
                        <td>65 km</td>
                        <td><del>1.625 TL</del></td>
                        <td><strong>1.560 TL</strong> ⭐</td>
                        <td class="save">65 TL</td>
                    </tr>
                    <tr class="discount-row">
                        <td><strong>Havalimanı - Kemer</strong></td>
                        <td>52 km</td>
                        <td><del>1.300 TL</del></td>
                        <td><strong>1.248 TL</strong> ⭐</td>
                        <td class="save">52 TL</td>
                    </tr>
                    <tr class="discount-row featured">
                        <td><strong>Havalimanı - Alanya</strong></td>
                        <td>130 km</td>
                        <td><del>3.250 TL</del></td>
                        <td><strong>2.730 TL</strong> ⭐⭐</td>
                        <td class="save">520 TL</td>
                    </tr>
                    <tr>
                        <td><strong>Şehir İçi (7-10 km)</strong></td>
                        <td>Örn: 8 km</td>
                        <td>200 TL</td>
                        <td><strong>200 TL</strong></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><strong>Şehir İçi (11-20 km)</strong></td>
                        <td>Örn: 15 km</td>
                        <td>375 TL</td>
                        <td><strong>375 TL</strong></td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="pricing-calculator" data-aos="fade-up">
            <h3><i class="fas fa-calculator"></i> Fiyat Hesaplama Aracı</h3>
            <p class="calculator-desc">Mesafenizi girin, indirimli fiyatınızı öğrenin!</p>
            <div class="calculator-box">
                <div class="form-group">
                    <label for="distance">Mesafe (KM):</label>
                    <input type="number" id="distance" class="form-control" placeholder="Örn: 65" min="0" step="0.1">
                </div>
                <button onclick="calculatePrice()" class="btn btn-primary">
                    <i class="fas fa-calculator"></i> Hesapla
                </button>
                <div id="result" class="calculator-result"></div>
            </div>
        </div>
        
        <div class="pricing-notes" data-aos="fade-up">
            <h4><i class="fas fa-info-circle"></i> Fiyatlandırma Sistemi:</h4>
            <ul>
                <li><strong>0-6 km:</strong> Sabit 150 TL</li>
                <li><strong>7-49 km:</strong> 25 TL/km (Normal fiyat)</li>
                <li><strong>50-74 km:</strong> 24 TL/km <span class="discount-tag">%4 İndirim</span></li>
                <li><strong>75-99 km:</strong> 23 TL/km <span class="discount-tag">%8 İndirim</span></li>
                <li><strong>100+ km:</strong> 21 TL/km <span class="discount-tag">%16 İndirim</span></li>
                <li><strong>⭐ Premium Araç:</strong> 50 km ve üzeri yolculuklarda aynı fiyata!</li>
                <li>Tüm fiyatlar KDV dahildir</li>
                <li>Gece tarifesi uygulanmaz (7/24 aynı fiyat)</li>
                <li>Bagaj ücreti alınmaz</li>
            </ul>
            
            <h4><i class="fas fa-credit-card"></i> Ödeme Yöntemleri:</h4>
            <ul>
                <li><strong>💵 Nakit:</strong> Araçta ödeme</li>
                <li><strong>🏦 IBAN:</strong> Banka transferi</li>
                <li><strong>💳 Kredi/Banka Kartı:</strong> Web üzerinden (Tutar + Komisyon)</li>
            </ul>
        </div>
    </div>
</section>

<!-- Payment Methods -->
<section class="payment-methods section-padding">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Ödeme Yöntemlerimiz</h2>
        </div>
        
        <div class="payment-grid">
            <div class="payment-card" data-aos="fade-up" data-aos-delay="100">
                <div class="payment-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3>Nakit Ödeme</h3>
                <p>Araçta nakit olarak ödeme yapabilirsiniz. Komisyon yoktur.</p>
            </div>
            
            <div class="payment-card" data-aos="fade-up" data-aos-delay="200">
                <div class="payment-icon">
                    <i class="fas fa-university"></i>
                </div>
                <h3>IBAN ile Ödeme</h3>
                <p>Banka hesabımıza transfer yapabilirsiniz. Dekont göstermeniz yeterli.</p>
            </div>
            
            <div class="payment-card" data-aos="fade-up" data-aos-delay="300">
                <div class="payment-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3>Kredi/Banka Kartı</h3>
                <p>Web sitemiz üzerinden güvenli ödeme. Tutar + banka komisyonu uygulanır.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="faq-section section-padding bg-light">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Sıkça Sorulan Sorular</h2>
        </div>
        
        <div class="faq-accordion" data-aos="fade-up">
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Uzun mesafelerde neden indirim var?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Uzun mesafe yolculuklarda müşterilerimize avantaj sağlamak için mesafe arttıkça km başı fiyatı düşürüyoruz. 100 km üzeri yolculuklarda %16'ya varan indirim kazanabilirsiniz!</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Premium araç avantajı nedir?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>50 km ve üzeri yolculuklarda ek ücret ödemeden 2025 BYD ATTO 3, 2024 TORRES EVX veya AUDİ A3 gibi premium araçlarımızla seyahat edebilirsiniz!</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Hangi ödeme yöntemlerini kabul ediyorsunuz?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Nakit, IBAN (banka transferi) ve Kredi/Banka Kartı ile ödeme yapabilirsiniz. Kredi kartı ödemelerinde banka komisyonu uygulanır.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>Gece tarifesi var mı?</h4>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Hayır, 7/24 aynı fiyatlarla hizmet veriyoruz. Gece tarifesi uygulanmaz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section section-padding">
    <div class="container">
        <div class="cta-content text-center" data-aos="zoom-in">
            <h2 class="cta-title">Hemen Fiyat Teklifi Alın!</h2>
            <p class="cta-description">Uzun mesafelerde indirimli fiyatlardan yararlanın</p>
            <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode('Fiyat teklifi almak istiyorum.'); ?>" 
               class="btn btn-primary btn-lg btn-pulse" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp ile Fiyat Al</span>
            </a>
        </div>
    </div>
</section>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({duration:800,once:true});

// Fiyat Hesaplama - İndirimli Sistem
function calculatePrice() {
    const distance = parseFloat(document.getElementById('distance').value);
    const resultDiv = document.getElementById('result');
    
    if (!distance || distance < 0) {
        resultDiv.innerHTML = '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Lütfen geçerli bir mesafe girin.</div>';
        return;
    }
    
    let price, normalPrice, pricePerKm, calculation, discount = 0, premiumInfo = '';
    
    if (distance <= 6) {
        price = 150;
        normalPrice = 150;
        calculation = 'Kısa mesafe sabit fiyat';
        pricePerKm = 0;
    } else if (distance <= 49) {
        pricePerKm = 25;
        price = distance * pricePerKm;
        normalPrice = price;
        calculation = distance + ' km × ' + pricePerKm + ' TL';
    } else if (distance <= 74) {
        pricePerKm = 24;
        price = distance * pricePerKm;
        normalPrice = distance * 25;
        discount = normalPrice - price;
        calculation = distance + ' km × ' + pricePerKm + ' TL (Normal: 25 TL/km)';
        premiumInfo = '<div class="premium-badge"><i class="fas fa-crown"></i> <strong>PREMIUM ARAÇ AVANTAJI!</strong><br>Aynı fiyata BYD ATTO 3, TORRES EVX veya AUDİ A3 ile seyahat edin!</div>';
    } else if (distance <= 99) {
        pricePerKm = 23;
        price = distance * pricePerKm;
        normalPrice = distance * 25;
        discount = normalPrice - price;
        calculation = distance + ' km × ' + pricePerKm + ' TL (Normal: 25 TL/km)';
        premiumInfo = '<div class="premium-badge"><i class="fas fa-crown"></i> <strong>PREMIUM ARAÇ AVANTAJI!</strong><br>Aynı fiyata BYD ATTO 3, TORRES EVX veya AUDİ A3 ile seyahat edin!</div>';
    } else {
        pricePerKm = 21;
        price = distance * pricePerKm;
        normalPrice = distance * 25;
        discount = normalPrice - price;
        calculation = distance + ' km × ' + pricePerKm + ' TL (Normal: 25 TL/km)';
        premiumInfo = '<div class="premium-badge"><i class="fas fa-crown"></i> <strong>PREMIUM ARAÇ AVANTAJI!</strong><br>Aynı fiyata BYD ATTO 3, TORRES EVX veya AUDİ A3 ile seyahat edin!</div>';
    }
    
    let discountInfo = '';
    if (discount > 0) {
        const discountPercent = ((discount / normalPrice) * 100).toFixed(0);
        discountInfo = `
            <div class="discount-info">
                <p><strong>Normal Fiyat:</strong> <del>${normalPrice.toFixed(2)} TL</del></p>
                <p class="discount-amount"><strong>İndirim:</strong> <span class="save">${discount.toFixed(2)} TL (%${discountPercent})</span></p>
            </div>
        `;
    }
    
    resultDiv.innerHTML = `
        <div class="alert alert-success">
            <h4><i class="fas fa-check-circle"></i> Hesaplama Sonucu</h4>
            <p><strong>Mesafe:</strong> ${distance} km</p>
            <p><strong>Hesaplama:</strong> ${calculation}</p>
            ${discountInfo}
            <p class="price-result"><strong>Toplam Ücret:</strong> <span class="highlight">${price.toFixed(2)} TL</span></p>
            ${premiumInfo}
        </div>
    `;
}

// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const item = question.parentElement;
        const wasActive = item.classList.contains('active');
        
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
        
        if (!wasActive) {
            item.classList.add('active');
        }
    });
});

// Enter tuşu ile hesaplama
document.getElementById('distance').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        calculatePrice();
    }
});
</script>

<style>
.discount-row {
    background: #fff8e1;
}
.discount-row.featured {
    background: #e8f5e9;
    font-weight: bold;
}
.save {
    color: #4caf50;
    font-weight: bold;
}
.discount-tag {
    background: #ff5722;
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 12px;
    margin-left: 5px;
}
.premium-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
    text-align: center;
}
.discount-info {
    background: #fff3cd;
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
}
.discount-amount {
    font-size: 18px;
}
.old-price {
    text-decoration: line-through;
    color: #999;
    font-size: 14px;
    display: block;
}
.pricing-highlight.discount {
    border: 2px solid #ff5722;
    position: relative;
}
.discount-badge {
    position: absolute;
    top: -10px;
    right: 10px;
    background: #ff5722;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}
.premium-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}
.premium-icon {
    font-size: 48px;
}
.premium-cars {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin: 15px 0;
}
.car-badge {
    background: rgba(255,255,255,0.2);
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 14px;
}
.premium-note {
    font-size: 14px;
    opacity: 0.9;
    margin-top: 10px;
}
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
