<?php
/**
 * SEO FONKSİYONLARI
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

/**
 * Meta tag'leri oluştur
 */
function generate_meta_tags($data = []) {
    $title = $data['title'] ?? DEFAULT_META_TITLE;
    $description = $data['description'] ?? DEFAULT_META_DESCRIPTION;
    $keywords = $data['keywords'] ?? DEFAULT_META_KEYWORDS;
    $image = $data['image'] ?? DEFAULT_OG_IMAGE;
    $url = $data['url'] ?? get_current_url();
    
    $html = '';
    
    // Basic Meta Tags
    $html .= '<meta charset="UTF-8">' . "\n";
    $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
    $html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n";
    $html .= '<title>' . htmlspecialchars($title) . '</title>' . "\n";
    $html .= '<meta name="description" content="' . htmlspecialchars($description) . '">' . "\n";
    $html .= '<meta name="keywords" content="' . htmlspecialchars($keywords) . '">' . "\n";
    $html .= '<meta name="author" content="' . SITE_NAME . '">' . "\n";
    $html .= '<meta name="robots" content="index, follow">' . "\n";
    $html .= '<link rel="canonical" href="' . htmlspecialchars($url) . '">' . "\n";
    
    // Open Graph Tags
    $html .= '<meta property="og:type" content="website">' . "\n";
    $html .= '<meta property="og:title" content="' . htmlspecialchars($title) . '">' . "\n";
    $html .= '<meta property="og:description" content="' . htmlspecialchars($description) . '">' . "\n";
    $html .= '<meta property="og:url" content="' . htmlspecialchars($url) . '">' . "\n";
    $html .= '<meta property="og:image" content="' . htmlspecialchars($image) . '">' . "\n";
    $html .= '<meta property="og:site_name" content="' . SITE_NAME . '">' . "\n";
    $html .= '<meta property="og:locale" content="tr_TR">' . "\n";
    
    // Twitter Card Tags
    $html .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
    $html .= '<meta name="twitter:title" content="' . htmlspecialchars($title) . '">' . "\n";
    $html .= '<meta name="twitter:description" content="' . htmlspecialchars($description) . '">' . "\n";
    $html .= '<meta name="twitter:image" content="' . htmlspecialchars($image) . '">' . "\n";
    
    return $html;
}

/**
 * Local Business Schema oluştur
 */
function generate_local_business_schema() {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => SITE_NAME,
        'description' => DEFAULT_META_DESCRIPTION,
        'url' => SITE_URL,
        'telephone' => CONTACT_PHONE,
        'email' => CONTACT_EMAIL,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => CONTACT_ADDRESS,
            'addressLocality' => 'Antalya',
            'addressRegion' => 'Antalya',
            'postalCode' => '07000',
            'addressCountry' => 'TR'
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '36.8969',
            'longitude' => '30.7133'
        ],
        'openingHours' => 'Mo-Su 00:00-23:59',
        'priceRange' => '₺₺',
        'image' => DEFAULT_OG_IMAGE
    ];
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * Organization Schema oluştur
 */
function generate_organization_schema() {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => SITE_NAME,
        'url' => SITE_URL,
        'logo' => assets_url('images/logo/logo.png'),
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => CONTACT_PHONE,
            'contactType' => 'customer service',
            'areaServed' => 'TR',
            'availableLanguage' => ['Turkish', 'English', 'Russian']
        ],
        'sameAs' => []
    ];
    
    if (CONTACT_INSTAGRAM) {
        $schema['sameAs'][] = 'https://instagram.com/' . CONTACT_INSTAGRAM;
    }
    if (CONTACT_FACEBOOK) {
        $schema['sameAs'][] = 'https://facebook.com/' . CONTACT_FACEBOOK;
    }
    if (CONTACT_TWITTER) {
        $schema['sameAs'][] = 'https://twitter.com/' . CONTACT_TWITTER;
    }
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * Breadcrumb Schema oluştur
 */
function generate_breadcrumb_schema($breadcrumbs) {
    $items = [];
    $position = 1;
    
    foreach ($breadcrumbs as $crumb) {
        $items[] = [
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => $crumb['name'],
            'item' => $crumb['url']
        ];
    }
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items
    ];
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * Breadcrumb HTML oluştur
 */
function generate_breadcrumb($breadcrumbs) {
    if (empty($breadcrumbs)) {
        return '';
    }
    
    $html = '<nav class="breadcrumb-nav" aria-label="Breadcrumb">';
    $html .= '<div class="container">';
    $html .= '<ol class="breadcrumb">';
    
    $count = count($breadcrumbs);
    $i = 1;
    
    foreach ($breadcrumbs as $crumb) {
        $is_last = ($i === $count);
        $html .= '<li class="breadcrumb-item' . ($is_last ? ' active' : '') . '">';
        
        if ($is_last) {
            $html .= '<span>' . htmlspecialchars($crumb['name']) . '</span>';
        } else {
            $html .= '<a href="' . htmlspecialchars($crumb['url']) . '">' . htmlspecialchars($crumb['name']) . '</a>';
        }
        
        $html .= '</li>';
        $i++;
    }
    
    $html .= '</ol>';
    $html .= '</div>';
    $html .= '</nav>';
    
    return $html;
}

/**
 * Mevcut URL'i al
 */
function get_current_url() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
