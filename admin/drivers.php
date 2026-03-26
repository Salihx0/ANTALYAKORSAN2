<?php
require_once 'includes/auth.php';
$page_title = 'Sürücüler';
$page_icon = 'fa-user-tie';
include 'includes/header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <h1><i class="fas <?php echo $page_icon; ?>"></i> <?php echo $page_title; ?></h1>
        <a href="drivers-add.php" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Sürücü</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Sürücü yönetim sistemi yakında eklenecek.
            </div>
            <p>Bu sayfada sürücüleri görüntüleyebilir ve yönetebileceksiniz.</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
