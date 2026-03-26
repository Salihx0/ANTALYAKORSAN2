<?php
/**
 * XML SITEMAP GENERATOR
 * Antalya Korsan Taksi
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

// XML header
header('Content-Type: application/xml; charset=utf-8');

// Site URL
$site_url = 'https://antalyakorsan.com';

// Mevcut tarih
$current_date = date('Y-m-d');

// XML başlat
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    
    <!-- Ana Sayfa -->
    <url>
        <loc><?php echo $site_url; ?>/</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/?lang=ru"/>
    </url>
    
    <!-- Hakkımızda -->
    <url>
        <loc><?php echo $site_url; ?>/hakkimizda.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/hakkimizda.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/hakkimizda.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/hakkimizda.php?lang=ru"/>
    </url>
    
    <!-- Hizmetler -->
    <url>
        <loc><?php echo $site_url; ?>/hizmetler.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/hizmetler.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/hizmetler.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/hizmetler.php?lang=ru"/>
    </url>
    
    <!-- Fiyatlar -->
    <url>
        <loc><?php echo $site_url; ?>/fiyatlar.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/fiyatlar.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/fiyatlar.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/fiyatlar.php?lang=ru"/>
    </url>
    
    <!-- Blog -->
    <url>
        <loc><?php echo $site_url; ?>/blog.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/blog.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/blog.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/blog.php?lang=ru"/>
    </url>
    
    <!-- İletişim -->
    <url>
        <loc><?php echo $site_url; ?>/iletisim.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/iletisim.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/iletisim.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/iletisim.php?lang=ru"/>
    </url>
    
    <!-- KVKK -->
    <url>
        <loc><?php echo $site_url; ?>/kvkk.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/kvkk.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/kvkk.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/kvkk.php?lang=ru"/>
    </url>
    
    <!-- Gizlilik Politikası -->
    <url>
        <loc><?php echo $site_url; ?>/gizlilik-politikasi.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/gizlilik-politikasi.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/gizlilik-politikasi.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/gizlilik-politikasi.php?lang=ru"/>
    </url>
    
    <!-- Çerez Politikası -->
    <url>
        <loc><?php echo $site_url; ?>/cerez-politikasi.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/cerez-politikasi.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/cerez-politikasi.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/cerez-politikasi.php?lang=ru"/>
    </url>
    
    <!-- Hizmet Sözleşmesi -->
    <url>
        <loc><?php echo $site_url; ?>/hizmet-sozlesmesi.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/hizmet-sozlesmesi.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/hizmet-sozlesmesi.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/hizmet-sozlesmesi.php?lang=ru"/>
    </url>
    
    <!-- Kullanım Koşulları -->
    <url>
        <loc><?php echo $site_url; ?>/kullanim-kosullari.php</loc>
        <lastmod><?php echo $current_date; ?></lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo $site_url; ?>/kullanim-kosullari.php?lang=tr"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo $site_url; ?>/kullanim-kosullari.php?lang=en"/>
        <xhtml:link rel="alternate" hreflang="ru" href="<?php echo $site_url; ?>/kullanim-kosullari.php?lang=ru"/>
    </url>
    
    <?php
    // Blog yazıları (veritabanından çekilecek)
    // Örnek statik blog URL'leri
    $blog_posts = [
        ['id' => 1, 'slug' => 'antalya-havalimani-transfer-rehberi', 'date' => '2025-01-15'],
        ['id' => 2, 'slug' => 'antalya-sehir-ici-ulasim', 'date' => '2025-01-14'],
        ['id' => 3, 'slug' => 'taksi-ile-guvenli-seyahat', 'date' => '2025-01-13'],
        ['id' => 4, 'slug' => 'antalya-turistik-yerler', 'date' => '2025-01-12'],
        ['id' => 5, 'slug' => 'havalimaninda-taksi-bulma', 'date' => '2025-01-11'],
    ];
    
    foreach ($blog_posts as $post) {
        echo "\n    <!-- Blog: {$post['slug']} -->\n";
        echo "    <url>\n";
        echo "        <loc>{$site_url}/blog-detay.php?id={$post['id']}</loc>\n";
        echo "        <lastmod>{$post['date']}</lastmod>\n";
        echo "        <changefreq>monthly</changefreq>\n";
        echo "        <priority>0.6</priority>\n";
        echo "        <xhtml:link rel=\"alternate\" hreflang=\"tr\" href=\"{$site_url}/blog-detay.php?id={$post['id']}&amp;lang=tr\"/>\n";
        echo "        <xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"{$site_url}/blog-detay.php?id={$post['id']}&amp;lang=en\"/>\n";
        echo "        <xhtml:link rel=\"alternate\" hreflang=\"ru\" href=\"{$site_url}/blog-detay.php?id={$post['id']}&amp;lang=ru\"/>\n";
        echo "    </url>\n";
    }
    ?>
    
</urlset>
