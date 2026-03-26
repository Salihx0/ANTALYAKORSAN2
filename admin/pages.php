<?php
/**
 * SAYFA YÖNETİMİ
 * Admin Panel - Antalya Korsan Taksi
 */

require_once 'includes/auth.php';
require_once '../includes/db.php';

$page_title = 'Sayfalar';
$page_icon = 'fa-file-alt';

if (isset($_GET['delete'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM pages WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
        $success_message = 'Sayfa başarıyla silindi!';
    } catch (PDOException $e) {
        $error_message = 'Hata: ' . $e->getMessage();
    }
}

try {
    $stmt = $pdo->query("SELECT * FROM pages ORDER BY order_num ASC");
    $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = 'Sayfalar yüklenemedi: ' . $e->getMessage();
}

include 'includes/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <h1><i class="fas <?php echo $page_icon; ?>"></i> <?php echo $page_title; ?></h1>
        <a href="pages-add.php" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Sayfa</a>
    </div>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $success_message; ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Başlık</th>
                        <th>Slug</th>
                        <th>Şablon</th>
                        <th>Durum</th>
                        <th>Sıra</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pages as $page): ?>
                        <tr>
                            <td><?php echo $page['id']; ?></td>
                            <td><?php echo htmlspecialchars($page['title']); ?></td>
                            <td><code><?php echo htmlspecialchars($page['slug']); ?></code></td>
                            <td><?php echo htmlspecialchars($page['template']); ?></td>
                            <td>
                                <?php if ($page['status'] === 'active'): ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $page['order_num']; ?></td>
                            <td>
                                <a href="pages-edit.php?id=<?php echo $page['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="?delete=<?php echo $page['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
