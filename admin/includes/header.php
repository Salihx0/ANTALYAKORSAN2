<?php
/**
 * ADMİN PANELİ - HEADER
 * Antalya Korsan Taksi
 */
?>

<header class="admin-header">
    <div class="header-left">
        <!-- Mobile Menu Toggle -->
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Search -->
        <div class="header-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Ara... (Ctrl + K)" id="globalSearch">
        </div>
    </div>
    
    <div class="header-right">
        <!-- Notifications -->
        <div class="header-item dropdown">
            <button class="header-btn" id="notificationsBtn">
                <i class="fas fa-bell"></i>
                <span class="badge-dot"></span>
            </button>
            <div class="dropdown-menu notifications-menu" id="notificationsMenu">
                <div class="dropdown-header">
                    <h4>Bildirimler</h4>
                    <a href="#" class="mark-read">Tümünü Okundu İşaretle</a>
                </div>
                <div class="notifications-list">
                    <a href="#" class="notification-item unread">
                        <div class="notification-icon bg-primary">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="notification-content">
                            <p><strong>Yeni Rezervasyon</strong></p>
                            <span>Ahmet Yılmaz - Havalimanı Transfer</span>
                            <small>5 dakika önce</small>
                        </div>
                    </a>
                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="notification-content">
                            <p><strong>Rezervasyon Tamamlandı</strong></p>
                            <span>BK-2025-001 numaralı rezervasyon</span>
                            <small>1 saat önce</small>
                        </div>
                    </a>
                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="notification-content">
                            <p><strong>Ödeme Bekliyor</strong></p>
                            <span>3 rezervasyon için ödeme bekleniyor</span>
                            <small>2 saat önce</small>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer">
                    <a href="notifications.php">Tüm Bildirimleri Gör</a>
                </div>
            </div>
        </div>
        
        <!-- Messages -->
        <div class="header-item dropdown">
            <button class="header-btn" id="messagesBtn">
                <i class="fas fa-envelope"></i>
                <span class="badge-count">3</span>
            </button>
            <div class="dropdown-menu messages-menu" id="messagesMenu">
                <div class="dropdown-header">
                    <h4>Mesajlar</h4>
                </div>
                <div class="messages-list">
                    <a href="#" class="message-item unread">
                        <img src="https://ui-avatars.com/api/?name=Ahmet+Yilmaz&background=667eea&color=fff" alt="Avatar">
                        <div class="message-content">
                            <p><strong>Ahmet Yılmaz</strong></p>
                            <span>Rezervasyon detayları hakkında...</span>
                            <small>10 dk önce</small>
                        </div>
                    </a>
                    <a href="#" class="message-item">
                        <img src="https://ui-avatars.com/api/?name=Mehmet+Demir&background=43e97b&color=fff" alt="Avatar">
                        <div class="message-content">
                            <p><strong>Mehmet Demir</strong></p>
                            <span>Teşekkürler, harika bir hizmet...</span>
                            <small>1 saat önce</small>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer">
                    <a href="messages.php">Tüm Mesajları Gör</a>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="header-item dropdown">
            <button class="header-btn" id="quickActionsBtn">
                <i class="fas fa-plus-circle"></i>
            </button>
            <div class="dropdown-menu quick-actions-menu" id="quickActionsMenu">
                <a href="bookings.php?action=new" class="quick-action-item">
                    <i class="fas fa-calendar-plus"></i>
                    <span>Yeni Rezervasyon</span>
                </a>
                <a href="customers.php?action=new" class="quick-action-item">
                    <i class="fas fa-user-plus"></i>
                    <span>Yeni Müşteri</span>
                </a>
                <a href="blog.php?action=new" class="quick-action-item">
                    <i class="fas fa-pen"></i>
                    <span>Blog Yazısı</span>
                </a>
                <a href="reports.php" class="quick-action-item">
                    <i class="fas fa-file-alt"></i>
                    <span>Rapor Oluştur</span>
                </a>
            </div>
        </div>
        
        <!-- User Profile -->
        <div class="header-item dropdown">
            <button class="header-btn user-btn" id="userMenuBtn">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['admin_username']); ?>&background=667eea&color=fff" alt="User">
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-menu user-menu" id="userMenu">
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['admin_username']); ?>&background=667eea&color=fff&size=64" alt="User">
                    <div>
                        <p><strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></p>
                        <span>Yönetici</span>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="profile.php" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    <span>Profilim</span>
                </a>
                <a href="settings.php" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    <span>Ayarlar</span>
                </a>
                <a href="../index.php" class="dropdown-item" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Siteyi Görüntüle</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="logout.php" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Çıkış Yap</span>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
// Dropdown Toggle
document.querySelectorAll('.header-item.dropdown').forEach(item => {
    const btn = item.querySelector('.header-btn');
    const menu = item.querySelector('.dropdown-menu');
    
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        
        // Close other dropdowns
        document.querySelectorAll('.dropdown-menu.show').forEach(m => {
            if (m !== menu) m.classList.remove('show');
        });
        
        menu.classList.toggle('show');
    });
});

// Close dropdowns on outside click
document.addEventListener('click', () => {
    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
        menu.classList.remove('show');
    });
});

// Prevent dropdown close on inside click
document.querySelectorAll('.dropdown-menu').forEach(menu => {
    menu.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});

// Global Search Shortcut (Ctrl + K)
document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        document.getElementById('globalSearch').focus();
    }
});
</script>
