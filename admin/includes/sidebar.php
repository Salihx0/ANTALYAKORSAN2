<?php
/**
 * ADMİN PANELİ - SIDEBAR
 * Antalya Korsan Taksi
 */

$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>

<aside class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <i class="fas fa-taxi"></i>
        <span>Korsan Taksi</span>
    </div>
    
    <!-- Navigation -->
    <nav class="sidebar-nav">
        <ul>
            <!-- Dashboard -->
            <li class="<?php echo $current_page === 'dashboard' ? 'active' : ''; ?>">
                <a href="dashboard.php">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <!-- Rezervasyonlar -->
            <li class="<?php echo $current_page === 'bookings' ? 'active' : ''; ?>">
                <a href="bookings.php">
                    <i class="fas fa-calendar-check"></i>
                    <span>Rezervasyonlar</span>
                    <span class="badge">23</span>
                </a>
            </li>
            
            <!-- Müşteriler -->
            <li class="<?php echo $current_page === 'customers' ? 'active' : ''; ?>">
                <a href="customers.php">
                    <i class="fas fa-users"></i>
                    <span>Müşteriler</span>
                </a>
            </li>
            
            <!-- Sürücüler -->
            <li class="<?php echo $current_page === 'drivers' ? 'active' : ''; ?>">
                <a href="drivers.php">
                    <i class="fas fa-user-tie"></i>
                    <span>Sürücüler</span>
                </a>
            </li>
            
            <!-- Araçlar -->
            <li class="<?php echo $current_page === 'vehicles' ? 'active' : ''; ?>">
                <a href="vehicles.php">
                    <i class="fas fa-car"></i>
                    <span>Araçlar</span>
                </a>
            </li>
            
            <!-- Blog -->
            <li class="nav-section">
                <span>İçerik Yönetimi</span>
            </li>
            
            <li class="<?php echo $current_page === 'blog' ? 'active' : ''; ?>">
                <a href="blog.php">
                    <i class="fas fa-blog"></i>
                    <span>Blog Yazıları</span>
                </a>
            </li>
            
            <li class="<?php echo $current_page === 'pages' ? 'active' : ''; ?>">
                <a href="pages.php">
                    <i class="fas fa-file-alt"></i>
                    <span>Sayfalar</span>
                </a>
            </li>
            
            <!-- Raporlar -->
            <li class="nav-section">
                <span>Raporlar & Analiz</span>
            </li>
            
            <li class="<?php echo $current_page === 'reports' ? 'active' : ''; ?>">
                <a href="reports.php">
                    <i class="fas fa-chart-bar"></i>
                    <span>Raporlar</span>
                </a>
            </li>
            
            <li class="<?php echo $current_page === 'analytics' ? 'active' : ''; ?>">
                <a href="analytics.php">
                    <i class="fas fa-chart-line"></i>
                    <span>Analitik</span>
                </a>
            </li>
            
            <!-- Ayarlar -->
            <li class="nav-section">
                <span>Sistem</span>
            </li>
            
            <li class="<?php echo $current_page === 'settings' ? 'active' : ''; ?>">
                <a href="settings.php">
                    <i class="fas fa-cog"></i>
                    <span>Ayarlar</span>
                </a>
            </li>
            
            <li class="<?php echo $current_page === 'users' ? 'active' : ''; ?>">
                <a href="users.php">
                    <i class="fas fa-user-shield"></i>
                    <span>Kullanıcılar</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Çıkış Yap</span>
        </a>
    </div>
</aside>

<!-- Sidebar Toggle (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
