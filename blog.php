<?php
/**
 * BLOG SAYFASI
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
$page_title = 'Blog - Antalya Korsan Taksi | Taksi ve Ulaşım Hakkında Her Şey';
$page_description = 'Antalya taksi hizmetleri, ulaşım ipuçları, turistik yerler ve daha fazlası hakkında güncel blog yazıları. Antalya\'da ulaşım hakkında bilmeniz gereken her şey.';
$page_keywords = 'antalya taksi blog, ulaşım ipuçları, antalya gezilecek yerler, taksi rehberi, antalya ulaşım';
$page_image = assets_url('images/blog/blog-main.jpg');
$body_class = 'blog-page';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 9;
$offset = ($page - 1) * $per_page;

// Kategori filtresi
$category = isset($_GET['category']) ? sanitize_input($_GET['category']) : '';

$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => site_url()],
    ['name' => 'Blog', 'url' => '']
];

include __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('<?php echo assets_url('images/headers/blog-header.jpg'); ?>');">
        <div class="page-header-overlay"></div>
    </div>
    <div class="container">
        <div class="page-header-content" data-aos="fade-up">
            <h1 class="page-title">Blog</h1>
            <p class="page-subtitle">Antalya Ulaşım ve Taksi Hakkında Her Şey</p>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="blog-content section-padding">
    <div class="container">
        <div class="row">
            <!-- Blog Posts -->
            <div class="col-lg-8">
                <div class="blog-posts">
                    <?php
                    try {
                        // Makaleleri getir
                        $articles = get_articles($per_page, $offset, $category);
                        $total_articles = count_articles($category);
                        $total_pages = ceil($total_articles / $per_page);
                        
                        if (!empty($articles)) {
                            foreach ($articles as $article) {
                                ?>
                                <article class="blog-post" data-aos="fade-up">
                                    <div class="post-image">
                                        <a href="<?php echo site_url('blog/' . $article['slug']); ?>">
                                            <img src="<?php echo $article['featured_image'] ?? assets_url('images/blog/placeholder.jpg'); ?>" 
                                                 alt="<?php echo htmlspecialchars($article['title']); ?>" 
                                                 class="lazy">
                                        </a>
                                        <div class="post-category">
                                            <a href="<?php echo site_url('blog?category=' . $article['category_slug']); ?>">
                                                <?php echo htmlspecialchars($article['category_name'] ?? 'Genel'); ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <span class="post-date">
                                                <i class="fas fa-calendar"></i>
                                                <?php echo format_date($article['published_at']); ?>
                                            </span>
                                            <span class="post-author">
                                                <i class="fas fa-user"></i>
                                                <?php echo htmlspecialchars($article['author_name'] ?? 'Admin'); ?>
                                            </span>
                                            <span class="post-reading-time">
                                                <i class="fas fa-clock"></i>
                                                <?php echo reading_time($article['content']); ?> dk
                                            </span>
                                        </div>
                                        <h2 class="post-title">
                                            <a href="<?php echo site_url('blog/' . $article['slug']); ?>">
                                                <?php echo htmlspecialchars($article['title']); ?>
                                            </a>
                                        </h2>
                                        <p class="post-excerpt">
                                            <?php echo create_excerpt($article['content'], 200); ?>
                                        </p>
                                        <a href="<?php echo site_url('blog/' . $article['slug']); ?>" class="post-link">
                                            Devamını Oku <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                                <?php
                            }
                            
                            // Pagination
                            if ($total_pages > 1) {
                                ?>
                                <div class="pagination">
                                    <?php if ($page > 1): ?>
                                        <a href="?page=<?php echo $page - 1; ?><?php echo $category ? '&category=' . $category : ''; ?>" class="page-link">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <a href="?page=<?php echo $i; ?><?php echo $category ? '&category=' . $category : ''; ?>" 
                                           class="page-link <?php echo $i == $page ? 'active' : ''; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    <?php endfor; ?>
                                    
                                    <?php if ($page < $total_pages): ?>
                                        <a href="?page=<?php echo $page + 1; ?><?php echo $category ? '&category=' . $category : ''; ?>" class="page-link">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }
                        } else {
                            // Placeholder makaleler
                            $placeholder_articles = [
                                [
                                    'title' => 'Antalya Havalimanı Transfer Rehberi',
                                    'excerpt' => 'Antalya Havalimanı\'ndan şehir merkezine ulaşım için bilmeniz gereken her şey. Transfer seçenekleri, fiyatlar ve ipuçları.',
                                    'category' => 'Havalimanı Transfer',
                                    'date' => '15 Kasım 2025',
                                    'image' => 'airport-transfer.jpg'
                                ],
                                [
                                    'title' => 'Antalya\'da Gezilecek En İyi 10 Yer',
                                    'excerpt' => 'Antalya\'nın tarihi ve turistik yerlerini keşfedin. Kaleiçi, Düden Şelalesi ve daha fazlası hakkında detaylı bilgiler.',
                                    'category' => 'Gezi Rehberi',
                                    'date' => '12 Kasım 2025',
                                    'image' => 'tourist-places.jpg'
                                ],
                                [
                                    'title' => 'Taksi Kullanırken Dikkat Edilmesi Gerekenler',
                                    'excerpt' => 'Güvenli ve ekonomik taksi yolculuğu için ipuçları. Fiyat hesaplama, güvenlik ve daha fazlası.',
                                    'category' => 'Taksi İpuçları',
                                    'date' => '10 Kasım 2025',
                                    'image' => 'taxi-tips.jpg'
                                ]
                            ];
                            
                            foreach ($placeholder_articles as $index => $article) {
                                ?>
                                <article class="blog-post" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                                    <div class="post-image">
                                        <a href="<?php echo site_url('blog'); ?>">
                                            <img src="<?php echo assets_url('images/blog/' . $article['image']); ?>" 
                                                 alt="<?php echo $article['title']; ?>" 
                                                 class="lazy">
                                        </a>
                                        <div class="post-category">
                                            <a href="#"><?php echo $article['category']; ?></a>
                                        </div>
                                    </div>
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <span class="post-date">
                                                <i class="fas fa-calendar"></i>
                                                <?php echo $article['date']; ?>
                                            </span>
                                            <span class="post-author">
                                                <i class="fas fa-user"></i>
                                                Admin
                                            </span>
                                            <span class="post-reading-time">
                                                <i class="fas fa-clock"></i>
                                                5 dk
                                            </span>
                                        </div>
                                        <h2 class="post-title">
                                            <a href="<?php echo site_url('blog'); ?>">
                                                <?php echo $article['title']; ?>
                                            </a>
                                        </h2>
                                        <p class="post-excerpt">
                                            <?php echo $article['excerpt']; ?>
                                        </p>
                                        <a href="<?php echo site_url('blog'); ?>" class="post-link">
                                            Devamını Oku <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                                <?php
                            }
                        }
                    } catch (Exception $e) {
                        echo '<div class="alert alert-info">Makaleler yükleniyor...</div>';
                    }
                    ?>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="blog-sidebar">
                    <!-- Search -->
                    <div class="sidebar-widget" data-aos="fade-up">
                        <h3 class="widget-title">Ara</h3>
                        <form class="search-form" action="<?php echo site_url('blog'); ?>" method="get">
                            <input type="text" name="s" placeholder="Ara..." class="form-control">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Categories -->
                    <div class="sidebar-widget" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="widget-title">Kategoriler</h3>
                        <ul class="category-list">
                            <li>
                                <a href="<?php echo site_url('blog'); ?>">
                                    <i class="fas fa-folder"></i>
                                    <span>Tüm Yazılar</span>
                                    <span class="count">(15)</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('blog?category=havalimani-transfer'); ?>">
                                    <i class="fas fa-plane"></i>
                                    <span>Havalimanı Transfer</span>
                                    <span class="count">(5)</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('blog?category=gezi-rehberi'); ?>">
                                    <i class="fas fa-map-marked-alt"></i>
                                    <span>Gezi Rehberi</span>
                                    <span class="count">(4)</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('blog?category=taksi-ipuclari'); ?>">
                                    <i class="fas fa-lightbulb"></i>
                                    <span>Taksi İpuçları</span>
                                    <span class="count">(3)</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('blog?category=antalya-ulasim'); ?>">
                                    <i class="fas fa-car"></i>
                                    <span>Antalya Ulaşım</span>
                                    <span class="count">(3)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Popular Posts -->
                    <div class="sidebar-widget" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="widget-title">Popüler Yazılar</h3>
                        <div class="popular-posts">
                            <div class="popular-post">
                                <div class="post-thumb">
                                    <img src="<?php echo assets_url('images/blog/thumb-1.jpg'); ?>" alt="Post" class="lazy">
                                </div>
                                <div class="post-info">
                                    <h4><a href="#">Antalya Havalimanı Transfer Rehberi</a></h4>
                                    <span class="post-date"><i class="fas fa-calendar"></i> 15 Kas 2025</span>
                                </div>
                            </div>
                            <div class="popular-post">
                                <div class="post-thumb">
                                    <img src="<?php echo assets_url('images/blog/thumb-2.jpg'); ?>" alt="Post" class="lazy">
                                </div>
                                <div class="post-info">
                                    <h4><a href="#">Antalya\'da Gezilecek Yerler</a></h4>
                                    <span class="post-date"><i class="fas fa-calendar"></i> 12 Kas 2025</span>
                                </div>
                            </div>
                            <div class="popular-post">
                                <div class="post-thumb">
                                    <img src="<?php echo assets_url('images/blog/thumb-3.jpg'); ?>" alt="Post" class="lazy">
                                </div>
                                <div class="post-info">
                                    <h4><a href="#">Taksi Kullanım İpuçları</a></h4>
                                    <span class="post-date"><i class="fas fa-calendar"></i> 10 Kas 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <div class="sidebar-widget" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="widget-title">Etiketler</h3>
                        <div class="tag-cloud">
                            <a href="#" class="tag">Antalya Taksi</a>
                            <a href="#" class="tag">Havalimanı</a>
                            <a href="#" class="tag">Transfer</a>
                            <a href="#" class="tag">Ulaşım</a>
                            <a href="#" class="tag">Gezi</a>
                            <a href="#" class="tag">Turizm</a>
                            <a href="#" class="tag">İpuçları</a>
                            <a href="#" class="tag">Rehber</a>
                        </div>
                    </div>
                    
                    <!-- CTA Widget -->
                    <div class="sidebar-widget cta-widget" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="widget-title">Araç Çağır</h3>
                        <p>7/24 güvenilir taksi hizmeti için hemen WhatsApp'tan ulaşın.</p>
                        <a href="https://wa.me/<?php echo str_replace('+', '', CONTACT_WHATSAPP); ?>?text=<?php echo urlencode(WHATSAPP_MESSAGE); ?>" 
                           class="btn btn-primary btn-block" 
                           target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp ile Ara</span>
                        </a>
                    </div>
                </aside>
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
