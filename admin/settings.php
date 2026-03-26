<?php
/**
 * AYARLAR SAYFASI
 * Admin Panel - Antalya Korsan Taksi
 */

require_once 'includes/auth.php';
require_once '../includes/db.php';

$page_title = 'Ayarlar';
$page_icon = 'fa-cog';

// Ayarları kaydet
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    try {
        foreach ($_POST as $key => $value) {
            if ($key !== 'save_settings') {
                $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
                $stmt->execute([$value, $key]);
            }
        }
        $success_message = 'Ayarlar başarıyla kaydedildi!';
    } catch (PDOException $e) {
        $error_message = 'Hata: ' . $e->getMessage();
    }
}

// Ayarları çek
try {
    $stmt = $pdo->query("SELECT * FROM settings ORDER BY category, setting_key");
    $settings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $grouped_settings = [];
    foreach ($settings as $setting) {
        $grouped_settings[$setting['category']][] = $setting;
    }
} catch (PDOException $e) {
    $error_message = 'Ayarlar yüklenemedi: ' . $e->getMessage();
}

include 'includes/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <h1><i class="fas <?php echo $page_icon; ?>"></i> <?php echo $page_title; ?></h1>
    </div>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo $success_message; ?></div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <?php foreach ($grouped_settings as $category => $category_settings): ?>
            <div class="card mb-4">
                <div class="card-header"><h3><?php echo ucfirst($category); ?></h3></div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($category_settings as $setting): ?>
                            <div class="col-md-6 mb-3">
                                <label><?php echo $setting['description'] ?: $setting['setting_key']; ?></label>
                                <?php if ($setting['setting_type'] === 'textarea'): ?>
                                    <textarea name="<?php echo htmlspecialchars($setting['setting_key']); ?>" class="form-control" rows="3"><?php echo htmlspecialchars($setting['setting_value']); ?></textarea>
                                <?php elseif ($setting['setting_type'] === 'boolean'): ?>
                                    <select name="<?php echo htmlspecialchars($setting['setting_key']); ?>" class="form-control">
                                        <option value="1" <?php echo $setting['setting_value'] == '1' ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="0" <?php echo $setting['setting_value'] == '0' ? 'selected' : ''; ?>>Pasif</option>
                                    </select>
                                <?php else: ?>
                                    <input type="<?php echo $setting['setting_type']; ?>" name="<?php echo htmlspecialchars($setting['setting_key']); ?>" value="<?php echo htmlspecialchars($setting['setting_value']); ?>" class="form-control">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" name="save_settings" class="btn btn-primary"><i class="fas fa-save"></i> Kaydet</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
