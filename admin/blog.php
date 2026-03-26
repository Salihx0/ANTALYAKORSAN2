<?php
/**
 * BLOG YÖNETİMİ
 * Admin Panel - Antalya Korsan Taksi
 */

require_once 'includes/auth.php';
require_once '../includes/db.php';

$page_title = 'Blog Yazıları';
$page_icon = 'fa-blog';

// Silme işlemi
if (isset($_GET['delete'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
        $success_message = 'Yazı başarıyla silindi!';
    } catch (PDOException $e) {
        $error_message = 'Hata: ' . $e->getMessage();
    }
}

// Yazıları çek
try {
    $stmt = $pdo->query("SELECT a.*, u.username FROM articles a LEFT JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC");
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = 'Yazılar yüklenemedi: ' . $e->getMessage();
}

include 'includes/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <h1><i class="fas <?php echo $page_icon; ?>"></i> <?php echo $page_title; ?></h1>
        <a href="blog-add.php" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Yazı</a>
    </div>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $success_message; ?></div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Yazar</th>
                        <th>Durum</th>
                        <th>Görüntülenme</th>
                        <th>Tarih</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($articles)): ?>
                        <tr><td colspan="8" class="text-center">Henüz yazı eklenmemiş</td></tr>
                    <?php else: ?>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?php echo $article['id']; ?></td>
                                <td><?php echo htmlspecialchars($article['title']); ?></td>
                                <td><span class="badge badge-info"><?php echo htmlspecialchars($article['category']); ?></span></td>
                                <td><?php echo htmlspecialchars($article['username']); ?></td>
                                <td>
                                    <?php if ($article['status'] === 'published'): ?>
                                        <span class="badge badge-success">Yayında</span>
                                    <?php elseif ($article['status'] === 'draft'): ?>
                                        <span class="badge badge-warning">Taslak</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Zamanlanmış</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo number_format($article['views']); ?></td>
                                <td><?php echo date('d.m.Y', strtotime($article['created_at'])); ?></td>
                                <td>
                                    <a href="blog-edit.php?id=<?php echo $article['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="?delete=<?php echo $article['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
