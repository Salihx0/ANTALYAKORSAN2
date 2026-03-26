<?php
/**
 * ADMİN PANELİ - DASHBOARD
 * Antalya Korsan Taksi
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

session_start();

// Giriş kontrolü
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

// Veritabanı bağlantısı (simüle edilmiş veriler)
$stats = [
    'total_bookings' => 1247,
    'pending_bookings' => 23,
    'completed_bookings' => 1198,
    'cancelled_bookings' => 26,
    'total_revenue' => 156780,
    'monthly_revenue' => 24560,
    'total_customers' => 892,
    'active_drivers' => 15,
    'total_blog_posts' => 45,
    'total_reviews' => 234
];

$recent_bookings = [
    [
        'id' => 'BK-2025-001',
        'customer' => 'Ahmet Yılmaz',
        'from' => 'Havalimanı',
        'to' => 'Lara',
        'date' => '2025-01-18 14:30',
        'status' => 'pending',
        'price' => 250
    ],
    [
        'id' => 'BK-2025-002',
        'customer' => 'Mehmet Demir',
        'from' => 'Konyaaltı',
        'to' => 'Kaleiçi',
        'date' => '2025-01-18 15:00',
        'status' => 'completed',
        'price' => 120
    ],
    [
        'id' => 'BK-2025-003',
        'customer' => 'Ayşe Kaya',
        'from' => 'Kepez',
        'to' => 'Havalimanı',
        'date' => '2025-01-18 16:15',
        'status' => 'pending',
        'price' => 280
    ]
];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Panel</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="welcome-text">
                    <h1>Hoş Geldiniz, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>! 👋</h1>
                    <p>İşte bugünün özeti ve son aktiviteler</p>
                </div>
                <div class="welcome-actions">
                    <button class="btn btn-primary" onclick="location.href='bookings.php?action=new'">
                        <i class="fas fa-plus"></i>
                        Yeni Rezervasyon
                    </button>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-grid">
                <!-- Total Bookings -->
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Toplam Rezervasyon</h3>
                        <p class="stat-number"><?php echo number_format($stats['total_bookings']); ?></p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> 12% bu ay
                        </span>
                    </div>
                </div>
                
                <!-- Pending Bookings -->
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Bekleyen</h3>
                        <p class="stat-number"><?php echo $stats['pending_bookings']; ?></p>
                        <span class="stat-change">
                            <i class="fas fa-minus"></i> Değişim yok
                        </span>
                    </div>
                </div>
                
                <!-- Monthly Revenue -->
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-lira-sign"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Aylık Gelir</h3>
                        <p class="stat-number"><?php echo number_format($stats['monthly_revenue']); ?> ₺</p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> 8% artış
                        </span>
                    </div>
                </div>
                
                <!-- Total Customers -->
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Müşteriler</h3>
                        <p class="stat-number"><?php echo number_format($stats['total_customers']); ?></p>
                        <span class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> 15 yeni
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Charts Row -->
            <div class="charts-row">
                <!-- Revenue Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-line"></i> Gelir Grafiği</h3>
                        <select class="chart-filter">
                            <option>Son 7 Gün</option>
                            <option>Son 30 Gün</option>
                            <option>Son 12 Ay</option>
                        </select>
                    </div>
                    <canvas id="revenueChart"></canvas>
                </div>
                
                <!-- Bookings Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-pie"></i> Rezervasyon Durumu</h3>
                    </div>
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>
            
            <!-- Recent Bookings -->
            <div class="table-card">
                <div class="table-header">
                    <h3><i class="fas fa-list"></i> Son Rezervasyonlar</h3>
                    <a href="bookings.php" class="btn btn-sm btn-outline">
                        Tümünü Gör <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Rezervasyon No</th>
                                <th>Müşteri</th>
                                <th>Nereden</th>
                                <th>Nereye</th>
                                <th>Tarih/Saat</th>
                                <th>Ücret</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_bookings as $booking): ?>
                            <tr>
                                <td><strong><?php echo $booking['id']; ?></strong></td>
                                <td><?php echo htmlspecialchars($booking['customer']); ?></td>
                                <td><?php echo htmlspecialchars($booking['from']); ?></td>
                                <td><?php echo htmlspecialchars($booking['to']); ?></td>
                                <td><?php echo date('d.m.Y H:i', strtotime($booking['date'])); ?></td>
                                <td><strong><?php echo number_format($booking['price']); ?> ₺</strong></td>
                                <td>
                                    <?php if ($booking['status'] === 'pending'): ?>
                                        <span class="badge badge-warning">Bekliyor</span>
                                    <?php elseif ($booking['status'] === 'completed'): ?>
                                        <span class="badge badge-success">Tamamlandı</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">İptal</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon" title="Görüntüle">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-icon" title="Düzenle">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon btn-danger" title="Sil">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
                <h3><i class="fas fa-bolt"></i> Hızlı İşlemler</h3>
                <div class="actions-grid">
                    <a href="bookings.php?action=new" class="action-item">
                        <i class="fas fa-plus-circle"></i>
                        <span>Yeni Rezervasyon</span>
                    </a>
                    <a href="customers.php" class="action-item">
                        <i class="fas fa-user-plus"></i>
                        <span>Müşteri Ekle</span>
                    </a>
                    <a href="blog.php?action=new" class="action-item">
                        <i class="fas fa-pen"></i>
                        <span>Blog Yazısı</span>
                    </a>
                    <a href="reports.php" class="action-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Rapor Oluştur</span>
                    </a>
                </div>
            </div>
            
        </div>
        
        <!-- Footer -->
        <footer class="admin-footer">
            <p>&copy; 2025 Antalya Korsan Taksi. Tüm hakları saklıdır.</p>
        </footer>
        
    </div>
    
    <!-- Scripts -->
    <script src="assets/js/admin.js"></script>
    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt', 'Paz'],
                datasets: [{
                    label: 'Gelir (₺)',
                    data: [3200, 4100, 3800, 5200, 4800, 6100, 5500],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Bookings Chart
        const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
        new Chart(bookingsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tamamlandı', 'Bekliyor', 'İptal'],
                datasets: [{
                    data: [<?php echo $stats['completed_bookings']; ?>, <?php echo $stats['pending_bookings']; ?>, <?php echo $stats['cancelled_bookings']; ?>],
                    backgroundColor: ['#43e97b', '#f5576c', '#999'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>
