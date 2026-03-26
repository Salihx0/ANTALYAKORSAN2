<?php
require_once 'includes/auth.php';
$page_title = 'Rezervasyonlar';
$page_icon = 'fa-calendar-check';
include 'includes/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <h1><i class="fas <?php echo $page_icon; ?>"></i> <?php echo $page_title; ?></h1>
        <a href="bookings-add.php" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Rezervasyon</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Rezervasyon sistemi yakında eklenecek.
            </div>
            <p>Bu sayfada rezervasyonları görüntüleyebilir ve yönetebileceksiniz.</p>
            <ul>
                <li>Rezervasyon listesi</li>
                <li>Durum güncelleme</li>
                <li>Müşteri bilgileri</li>
                <li>Ödeme takibi</li>
            </ul>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
