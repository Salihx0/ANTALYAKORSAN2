<?php
require_once 'includes/auth.php';
$page_title = 'Analitik';
$page_icon = 'fa-chart-line';
include 'includes/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <h1><i class="fas <?php echo $page_icon; ?>"></i> <?php echo $page_title; ?></h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Analitik sistemi yakında eklenecek.
            </div>
            <p>Bu sayfada site istatistiklerini ve analizleri görüntüleyebileceksiniz.</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
