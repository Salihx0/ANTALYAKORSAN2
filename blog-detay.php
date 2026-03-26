<?php
/**
 * BLOG DETAY SAYFASI
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo.php';

// Makale slug'ını al
$slug = isset($_GET['slug']) ? sanitize_input($_GET['slug']) : '';

if (empty($slug)) {
    header('Location: ' . site_url('blog'));
    exit;
}

// Makaleyi getir
try {
    $article = get_article_by_slug($slug);
    
    if (!$article) {
        header('Location: ' . site_url('blog'));
        exit;
    }
} catch (Exception $e) {
    // Placeholder makale
    $article = [
        'title' => 'Antalya Korsan Taksi Hizmetleri Hakkında',
        'content' => '<p>Antalya\'da güvenilir ve ekonomik taksi hizmeti...</p>',
        'featured_image' => assets_url('images/blog/placeholder.jpg'),
        'published_at' => date('Y-m-d H:i:s'),
        'author_name' => 'Admin',
        'category_name' => 'Genel',
        'meta_description' => 'Antalya taksi hizmetleri hakkında detaylı bilgi'
    ];
}

// Sayfa bilgileri
$page_title = htmlspecialchars($article['title']) . ' - Antalya Korsan Taksi Blog';
$page_description = $article['meta_description'] ?? create_excerpt($article['content'], 160);
$page_keywords = $article['meta_keywords'] ?? 'antalya taksi, blog';
$page_image = $article['featured_image'] ?? assets_url('images/blog/placeholder.jpg');
$body_class = 'blog-detail-page';

$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => site_url()],
    ['name' => 'Blog', 'url' => site_url('blog')],
    ['name' => $article['title'], 'url' => '']
];

include __DIR__ . '/includes/header.php';
?>

<!-- Article Content -->
<article class="article-detail section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Article Header -->
                <header class="article-header" data-aos="fade-up">
                    <div class="article-category">
                        <a href="<?php echo site_url('blog?category=' . ($article['category_slug'] ?? '')); ?>">
                            <?php echo htmlspecialchars($article['category_name'] ?? 'Genel'); ?>
                        </a>
                    </div>
                    <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>
                    <div class="article-meta">
                        <span class="meta-item">
                            <i class="fas fa-user"></i>
                            <?php echo htmlspecialchars($article['author_name'] ?? 'Admin'); ?>
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <?php echo format_date($article['published_at']); ?>
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-clock"></i>
                            <?php echo reading_time($article['content']); ?> dk okuma
                        </span>
                    </div>
                </header>

                <!-- Featured Image -->
                <div class="article-image" data-aos="fade-up">
                    <img src="<?php echo $article['featured_image'] ?? assets_url('images/blog/placeholder.jpg'); ?>" 
                         alt="<?php echo htmlspecialchars($article['title']); ?>" 
                         class="lazy">
                </div>

                <!-- Article Body -->
                <div class="article-body" data-aos="fade-up">
                    <?php echo $article['content']; ?>
                </div>

                <!-- Article Footer -->
                <footer class="article-footer" data-aos="fade-up">
                    <div class="article-tags">
                        <?php
                        $tags = $article['tags'] ?? ['Antalya Taksi', 'Ulaşım', 'Transfer'];
                        foreach ($tags as $tag) {
                            echo '<a href="#" class="tag">' . htmlspecialchars($tag) . '</a>';
                        }
                        ?>
                    </div>
                    <div class="article-share">
                        <span>Paylaş:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(current_url()); ?>" target="_blank" class="share-btn">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(current_url()); ?>&text=<?php echo urlencode($article['title']); ?>" target="_blank" class="share-btn">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text=<?php echo urlencode($article['title'] . ' - ' . current_url()); ?>" target="_blank" class="share-btn">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</article>

<!-- CTA -->
<section class="cta-section section-padding">
    <div class="container">
        <div class="cta-content text-center" data-aos="zoom-in">
            <h2 class="cta-title">Hemen Araç Çağırın!</h2>
            <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode(WHATSAPP_MESSAGE); ?>" 
               class="btn btn-primary btn-lg" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp ile İletişime Geç</span>
            </a>
        </div>
    </div>
</section>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:800,once:true});</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
