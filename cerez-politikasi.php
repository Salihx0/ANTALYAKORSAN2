<?php
$page_title = "Çerez Politikası";
$page_description = "Antalya Korsan Taksi Çerez Politikası - Web sitemizde kullanılan çerezler hakkında bilgi";
$page_keywords = "çerez, cookie, çerez politikası, web çerezleri";
include 'includes/header.php';
?>

<!-- Cookie Policy Hero -->
<section class="legal-hero">
    <div class="container">
        <div class="legal-hero-content" data-aos="fade-up">
            <div class="legal-icon">
                <i class="fas fa-cookie-bite"></i>
            </div>
            <h1>Çerez Politikası</h1>
            <p class="legal-subtitle">Web Sitemizde Kullanılan Çerezler Hakkında Detaylı Bilgi</p>
            <div class="legal-meta">
                <span><i class="far fa-calendar"></i> Son Güncelleme: 18 Kasım 2025</span>
                <span><i class="far fa-clock"></i> Yürürlük Tarihi: 01 Ocak 2025</span>
            </div>
        </div>
    </div>
</section>

<!-- Cookie Policy Content -->
<section class="legal-content">
    <div class="container">
        <div class="legal-wrapper">
            
            <!-- Sidebar -->
            <aside class="legal-sidebar" data-aos="fade-right">
                <div class="legal-nav-sticky">
                    <h3>İçindekiler</h3>
                    <nav class="legal-nav">
                        <a href="#cerez-nedir" class="legal-nav-link">
                            <i class="fas fa-question-circle"></i> Çerez Nedir?
                        </a>
                        <a href="#neden-kullaniyoruz" class="legal-nav-link">
                            <i class="fas fa-lightbulb"></i> Neden Kullanıyoruz?
                        </a>
                        <a href="#cerez-turleri" class="legal-nav-link">
                            <i class="fas fa-list"></i> Çerez Türleri
                        </a>
                        <a href="#kullanilan-cerezler" class="legal-nav-link">
                            <i class="fas fa-cookie"></i> Kullanılan Çerezler
                        </a>
                        <a href="#ucuncu-taraf" class="legal-nav-link">
                            <i class="fas fa-share-alt"></i> Üçüncü Taraf Çerezler
                        </a>
                        <a href="#yonetim" class="legal-nav-link">
                            <i class="fas fa-cog"></i> Çerez Yönetimi
                        </a>
                        <a href="#haklariniz" class="legal-nav-link">
                            <i class="fas fa-user-shield"></i> Haklarınız
                        </a>
                        <a href="#iletisim" class="legal-nav-link">
                            <i class="fas fa-envelope"></i> İletişim
                        </a>
                    </nav>
                    
                    <div class="legal-cta">
                        <i class="fas fa-sliders-h"></i>
                        <h4>Çerez Tercihleriniz</h4>
                        <p>Çerez ayarlarınızı istediğiniz zaman değiştirebilirsiniz.</p>
                        <button onclick="openCookieSettings()" class="btn btn-primary">
                            <i class="fas fa-cog"></i> Ayarları Aç
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="legal-main" data-aos="fade-left">
                
                <!-- Çerez Nedir -->
                <div id="cerez-nedir" class="legal-section">
                    <h2><i class="fas fa-question-circle"></i> Çerez Nedir?</h2>
                    <div class="legal-intro">
                        <p class="lead">
                            Çerezler (cookies), bir web sitesini ziyaret ettiğinizde tarayıcınız tarafından cihazınıza 
                            (bilgisayar, tablet veya mobil cihaz) kaydedilen küçük metin dosyalarıdır.
                        </p>
                        <div class="info-box">
                            <h4><i class="fas fa-info-circle"></i> Çerezlerin Özellikleri</h4>
                            <ul>
                                <li><strong>Küçük Boyut:</strong> Genellikle birkaç kilobayt büyüklüğünde</li>
                                <li><strong>Metin Tabanlı:</strong> Sadece metin bilgisi içerir</li>
                                <li><strong>Güvenli:</strong> Virüs veya zararlı yazılım içermez</li>
                                <li><strong>Geçici veya Kalıcı:</strong> Oturum süresi veya belirli bir süre için saklanır</li>
                                <li><strong>Silinebilir:</strong> İstediğiniz zaman silebilirsiniz</li>
                            </ul>
                        </div>
                    </div>

                    <div class="cookie-visual">
                        <div class="cookie-flow">
                            <div class="flow-step">
                                <div class="flow-icon"><i class="fas fa-globe"></i></div>
                                <h4>1. Ziyaret</h4>
                                <p>Web sitesini ziyaret edersiniz</p>
                            </div>
                            <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                            <div class="flow-step">
                                <div class="flow-icon"><i class="fas fa-cookie"></i></div>
                                <h4>2. Çerez</h4>
                                <p>Tarayıcınıza çerez kaydedilir</p>
                            </div>
                            <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                            <div class="flow-step">
                                <div class="flow-icon"><i class="fas fa-sync"></i></div>
                                <h4>3. Tekrar Ziyaret</h4>
                                <p>Çerez okunur ve sizi tanır</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Neden Kullanıyoruz -->
                <div id="neden-kullaniyoruz" class="legal-section">
                    <h2><i class="fas fa-lightbulb"></i> Çerezleri Neden Kullanıyoruz?</h2>
                    <p>Çerezleri aşağıdaki amaçlarla kullanıyoruz:</p>
                    
                    <div class="purpose-grid">
                        <div class="purpose-card">
                            <div class="purpose-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h4>Kimlik Doğrulama</h4>
                            <p>Giriş yaptığınızda sizi tanımak ve oturumunuzu sürdürmek için</p>
                        </div>

                        <div class="purpose-card">
                            <div class="purpose-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h4>Tercihlerinizi Hatırlama</h4>
                            <p>Dil, tema ve diğer tercihlerinizi kaydetmek için</p>
                        </div>

                        <div class="purpose-card">
                            <div class="purpose-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4>Güvenlik</h4>
                            <p>Hesabınızı ve bilgilerinizi korumak için</p>
                        </div>

                        <div class="purpose-card">
                            <div class="purpose-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h4>Analiz</h4>
                            <p>Web sitesi kullanımını analiz etmek ve iyileştirmek için</p>
                        </div>

                        <div class="purpose-card">
                            <div class="purpose-icon">
                                <i class="fas fa-magic"></i>
                            </div>
                            <h4>Kişiselleştirme</h4>
                            <p>Size özel içerik ve öneriler sunmak için</p>
                        </div>

                        <div class="purpose-card">
                            <div class="purpose-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <h4>Pazarlama</h4>
                            <p>İlgili reklamlar göstermek için (izninizle)</p>
                        </div>
                    </div>
                </div>

                <!-- Çerez Türleri -->
                <div id="cerez-turleri" class="legal-section">
                    <h2><i class="fas fa-list"></i> Çerez Türleri</h2>
                    <p>Çerezler farklı kriterlere göre sınıflandırılabilir:</p>
                    
                    <div class="cookie-classification">
                        <!-- Süreye Göre -->
                        <div class="classification-group">
                            <h3><i class="fas fa-clock"></i> Süreye Göre Çerezler</h3>
                            <div class="classification-items">
                                <div class="classification-item">
                                    <div class="item-header">
                                        <i class="fas fa-hourglass-start"></i>
                                        <h4>Oturum Çerezleri (Session Cookies)</h4>
                                    </div>
                                    <p>Tarayıcıyı kapattığınızda otomatik olarak silinir. Geçici bilgileri saklar.</p>
                                    <div class="item-example">
                                        <strong>Örnek:</strong> Giriş oturumu, alışveriş sepeti
                                    </div>
                                </div>

                                <div class="classification-item">
                                    <div class="item-header">
                                        <i class="fas fa-hourglass-end"></i>
                                        <h4>Kalıcı Çerezler (Persistent Cookies)</h4>
                                    </div>
                                    <p>Belirli bir süre boyunca cihazınızda kalır. Tercihlerinizi hatırlar.</p>
                                    <div class="item-example">
                                        <strong>Örnek:</strong> Dil tercihi, tema seçimi, "Beni Hatırla"
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kaynağa Göre -->
                        <div class="classification-group">
                            <h3><i class="fas fa-server"></i> Kaynağa Göre Çerezler</h3>
                            <div class="classification-items">
                                <div class="classification-item">
                                    <div class="item-header">
                                        <i class="fas fa-home"></i>
                                        <h4>Birinci Taraf Çerezler (First-Party Cookies)</h4>
                                    </div>
                                    <p>Ziyaret ettiğiniz web sitesi tarafından oluşturulur ve yönetilir.</p>
                                    <div class="item-example">
                                        <strong>Örnek:</strong> antalyakorsan.com.tr çerezleri
                                    </div>
                                </div>

                                <div class="classification-item">
                                    <div class="item-header">
                                        <i class="fas fa-share-alt"></i>
                                        <h4>Üçüncü Taraf Çerezler (Third-Party Cookies)</h4>
                                    </div>
                                    <p>Başka web siteleri veya hizmetler tarafından oluşturulur.</p>
                                    <div class="item-example">
                                        <strong>Örnek:</strong> Google Analytics, Facebook Pixel
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- İşleve Göre -->
                        <div class="classification-group">
                            <h3><i class="fas fa-tasks"></i> İşleve Göre Çerezler</h3>
                            <div class="classification-items">
                                <div class="classification-item">
                                    <div class="item-header">
                                        <i class="fas fa-check-circle"></i>
                                        <h4>Zorunlu Çerezler</h4>
                                        <span class="badge badge-required">Gerekli</span>
                                    </div>
                                    <p>Web sitesinin temel işlevleri için gereklidir. Devre dışı bırakılamaz.</p>
                                    <ul>
                                        <li>Oturum yönetimi</li>
                                        <li>Güvenlik</li>
                                        <li>Yük dengeleme</li>
                                    </ul>
                                </div>

                                <div class="classification-item">
                                    <div class="item-header">
                                        <i class="fas fa-cog"></i>
                                        <h4>İşlevsel Çerezler</h4>
                                        <span class="badge badge-optional">İsteğe Bağlı</span>
                                    </div>
                                    <p>Gelişmiş özellikler ve kişiselleştirme için kullanılır.</p>
                                    <ul>
                                        <li>Dil tercihi</li>
                                        <li>Tema seçimi</li>
                                        <li>Bölge ayarları</li>
                                    </ul>
                                </div>

                                <div class="classification-item">
                                    <div class="item-header">
                                        <i class="fas fa-chart-bar"></i>
                                        <h4>Analitik Çerezler</h4>
                                        <span class="badge badge-optional">İsteğe Bağlı</span>
                                    </div>
                                    <p>Web sitesi kullanımını analiz etmek için kullanılır.</p>
                                    <ul>
                                        <li>Ziyaretçi sayısı</li>
                                        <li>Sayfa görüntüleme</li>
                                        <li>Kullanıcı davranışı</li>
                                    </ul>
                                </div>

                                <div class="classification-item">
                                    <div class="item-header">
                                        <i class="fas fa-ad"></i>
                                        <h4>Pazarlama Çerezleri</h4>
                                        <span class="badge badge-optional">İsteğe Bağlı</span>
                                    </div>
                                    <p>Hedefli reklamlar göstermek için kullanılır.</p>
                                    <ul>
                                        <li>Reklam kişiselleştirme</li>
                                        <li>Remarketing</li>
                                        <li>Dönüşüm takibi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kullanılan Çerezler -->
                <div id="kullanilan-cerezler" class="legal-section">
                    <h2><i class="fas fa-cookie"></i> Web Sitemizde Kullanılan Çerezler</h2>
                    <p>Aşağıda web sitemizde kullandığımız çerezlerin detaylı listesi bulunmaktadır:</p>
                    
                    <!-- Zorunlu Çerezler -->
                    <div class="cookie-table-section">
                        <div class="table-header">
                            <h3><i class="fas fa-check-circle"></i> Zorunlu Çerezler</h3>
                            <span class="badge badge-required">Gerekli</span>
                        </div>
                        <div class="cookie-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Çerez Adı</th>
                                        <th>Amaç</th>
                                        <th>Süre</th>
                                        <th>Tür</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>PHPSESSID</code></td>
                                        <td>Oturum yönetimi ve kullanıcı kimlik doğrulama</td>
                                        <td>Oturum</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>csrf_token</code></td>
                                        <td>CSRF saldırılarına karşı güvenlik</td>
                                        <td>Oturum</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>cookie_consent</code></td>
                                        <td>Çerez tercihlerinizi kaydetme</td>
                                        <td>1 yıl</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>load_balancer</code></td>
                                        <td>Sunucu yük dengeleme</td>
                                        <td>Oturum</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- İşlevsel Çerezler -->
                    <div class="cookie-table-section">
                        <div class="table-header">
                            <h3><i class="fas fa-cog"></i> İşlevsel Çerezler</h3>
                            <span class="badge badge-optional">İsteğe Bağlı</span>
                        </div>
                        <div class="cookie-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Çerez Adı</th>
                                        <th>Amaç</th>
                                        <th>Süre</th>
                                        <th>Tür</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>theme_preference</code></td>
                                        <td>Tema tercihinizi (açık/koyu/kurumsal) kaydetme</td>
                                        <td>1 yıl</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>language</code></td>
                                        <td>Dil tercihinizi kaydetme</td>
                                        <td>1 yıl</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>remember_me</code></td>
                                        <td>"Beni Hatırla" özelliği</td>
                                        <td>30 gün</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>recent_searches</code></td>
                                        <td>Son aramalarınızı kaydetme</td>
                                        <td>7 gün</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Analitik Çerezler -->
                    <div class="cookie-table-section">
                        <div class="table-header">
                            <h3><i class="fas fa-chart-bar"></i> Analitik Çerezler</h3>
                            <span class="badge badge-optional">İsteğe Bağlı</span>
                        </div>
                        <div class="cookie-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Çerez Adı</th>
                                        <th>Amaç</th>
                                        <th>Süre</th>
                                        <th>Tür</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>_ga</code></td>
                                        <td>Google Analytics - Kullanıcıları ayırt etme</td>
                                        <td>2 yıl</td>
                                        <td>Üçüncü Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>_gid</code></td>
                                        <td>Google Analytics - Kullanıcıları ayırt etme</td>
                                        <td>24 saat</td>
                                        <td>Üçüncü Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>_gat</code></td>
                                        <td>Google Analytics - İstek oranını sınırlama</td>
                                        <td>1 dakika</td>
                                        <td>Üçüncü Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>analytics_session</code></td>
                                        <td>Dahili analitik - Oturum takibi</td>
                                        <td>30 dakika</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pazarlama Çerezleri -->
                    <div class="cookie-table-section">
                        <div class="table-header">
                            <h3><i class="fas fa-ad"></i> Pazarlama Çerezleri</h3>
                            <span class="badge badge-optional">İsteğe Bağlı</span>
                        </div>
                        <div class="cookie-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Çerez Adı</th>
                                        <th>Amaç</th>
                                        <th>Süre</th>
                                        <th>Tür</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>_fbp</code></td>
                                        <td>Facebook Pixel - Reklam kişiselleştirme</td>
                                        <td>3 ay</td>
                                        <td>Üçüncü Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>fr</code></td>
                                        <td>Facebook - Reklam gösterimi</td>
                                        <td>3 ay</td>
                                        <td>Üçüncü Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>IDE</code></td>
                                        <td>Google DoubleClick - Reklam hedefleme</td>
                                        <td>1 yıl</td>
                                        <td>Üçüncü Taraf</td>
                                    </tr>
                                    <tr>
                                        <td><code>marketing_consent</code></td>
                                        <td>Pazarlama izninizi kaydetme</td>
                                        <td>1 yıl</td>
                                        <td>Birinci Taraf</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Üçüncü Taraf Çerezler -->
                <div id="ucuncu-taraf" class="legal-section">
                    <h2><i class="fas fa-share-alt"></i> Üçüncü Taraf Çerezler</h2>
                    <p>Web sitemizde aşağıdaki üçüncü taraf hizmetleri kullanıyoruz:</p>
                    
                    <div class="third-party-services">
                        <div class="service-card">
                            <div class="service-header">
                                <img src="assets/images/google-analytics-logo.svg" alt="Google Analytics" class="service-logo">
                                <h4>Google Analytics</h4>
                            </div>
                            <p><strong>Amaç:</strong> Web sitesi trafiği ve kullanıcı davranışı analizi</p>
                            <p><strong>Çerezler:</strong> _ga, _gid, _gat</p>
                            <p><strong>Gizlilik Politikası:</strong> 
                                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">
                                    Google Gizlilik Politikası <i class="fas fa-external-link-alt"></i>
                                </a>
                            </p>
                            <p><strong>Opt-Out:</strong> 
                                <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">
                                    Google Analytics Opt-out <i class="fas fa-external-link-alt"></i>
                                </a>
                            </p>
                        </div>

                        <div class="service-card">
                            <div class="service-header">
                                <img src="assets/images/facebook-logo.svg" alt="Facebook" class="service-logo">
                                <h4>Facebook Pixel</h4>
                            </div>
                            <p><strong>Amaç:</strong> Reklam kişiselleştirme ve dönüşüm takibi</p>
                            <p><strong>Çerezler:</strong> _fbp, fr</p>
                            <p><strong>Gizlilik Politikası:</strong> 
                                <a href="https://www.facebook.com/privacy/explanation" target="_blank" rel="noopener">
                                    Facebook Gizlilik Politikası <i class="fas fa-external-link-alt"></i>
                                </a>
                            </p>
                            <p><strong>Opt-Out:</strong> 
                                <a href="https://www.facebook.com/settings?tab=ads" target="_blank" rel="noopener">
                                    Facebook Reklam Ayarları <i class="fas fa-external-link-alt"></i>
                                </a>
                            </p>
                        </div>

                        <div class="service-card">
                            <div class="service-header">
                                <img src="assets/images/google-maps-logo.svg" alt="Google Maps" class="service-logo">
                                <h4>Google Maps</h4>
                            </div>
                            <p><strong>Amaç:</strong> Harita gösterimi ve konum hizmetleri</p>
                            <p><strong>Çerezler:</strong> NID, CONSENT</p>
                            <p><strong>Gizlilik Politikası:</strong> 
                                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">
                                    Google Gizlilik Politikası <i class="fas fa-external-link-alt"></i>
                                </a>
                            </p>
                        </div>

                        <div class="service-card">
                            <div class="service-header">
                                <img src="assets/images/whatsapp-logo.svg" alt="WhatsApp" class="service-logo">
                                <h4>WhatsApp Business</h4>
                            </div>
                            <p><strong>Amaç:</strong> Müşteri iletişimi ve destek</p>
                            <p><strong>Çerezler:</strong> wa_session</p>
                            <p><strong>Gizlilik Politikası:</strong> 
                                <a href="https://www.whatsapp.com/legal/privacy-policy" target="_blank" rel="noopener">
                                    WhatsApp Gizlilik Politikası <i class="fas fa-external-link-alt"></i>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="warning-box">
                        <i class="fas fa-info-circle"></i>
                        <p><strong>Not:</strong> Üçüncü taraf çerezler, ilgili hizmet sağlayıcıların gizlilik politikalarına tabidir. 
                        Bu çerezlerin kullanımı hakkında daha fazla bilgi için lütfen ilgili gizlilik politikalarını inceleyin.</p>
                    </div>
                </div>

                <!-- Çerez Yönetimi -->
                <div id="yonetim" class="legal-section">
                    <h2><i class="fas fa-cog"></i> Çerez Yönetimi ve Kontrolü</h2>
                    <p>Çerezleri kontrol etmek ve yönetmek için birkaç seçeneğiniz vardır:</p>
