<?php
// Bootstrap application
require_once __DIR__ . '/../config/autoload.php';

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is admin
$user = new App\User();
if (!$user->isAdmin()) {
    header('Location: login.php');
    exit;
}

// Get analytics data
$analytics = new App\Analytics();
$analyticsData = $analytics->getAnalyticsData();
$totalVisits = $analyticsData ? $analyticsData->totalVisits : 0;
$uniqueVisitors = $analyticsData ? $analyticsData->uniqueVisitors : 0;

// Get orders data
$order = new App\Order();
$orderStats = $order->getOrderStats();
$totalOrders = isset($orderStats->totalOrders) ? $orderStats->totalOrders : 0;
$totalRevenue = isset($orderStats->totalRevenue) ? $orderStats->totalRevenue : 0;
$averageOrderValue = isset($orderStats->averageOrderValue) ? $orderStats->averageOrderValue : 0;

// Get recent orders
$recentOrders = $order->getAllOrders();

// Get top products
$topProducts = $analytics->getTopProducts(5);

// Get daily visits and sales data for charts
$dailyVisits = $analytics->getDailyVisitsData(30);
$dailySales = $analytics->getDailySalesData(30);

// Format data for charts
$visitLabels = [];
$visitData = [];
$salesLabels = [];
$salesData = [];
$revenueData = [];

foreach ($dailyVisits as $visit) {
    $visitLabels[] = "'" . date('d M', strtotime($visit->date)) . "'";
    $visitData[] = $visit->count;
}

foreach ($dailySales as $sale) {
    $salesLabels[] = "'" . date('d M', strtotime($sale->date)) . "'";
    $salesData[] = $sale->count;
    $revenueData[] = $sale->revenue;
}

// Get environment variables
$env = require_once __DIR__ . '/../config/env.php';
$siteName = $env['site_name'];

// Page title
$pageTitle = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Admin Panel</title>
    
    <!-- Favicon -->
    <link rel="icon" href="/assets/images/favicon.png" type="image/png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/admin.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h1 class="sidebar-logo"><?php echo $siteName; ?></h1>
                <div class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
            
            <div class="sidebar-user">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-info">
                    <h4><?php echo $_SESSION['user_name']; ?></h4>
                    <span>Administrator</span>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <ul class="nav-list">
                    <li class="nav-item active">
                        <a href="index.php" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="products.php" class="nav-link">
                            <i class="fas fa-box"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="orders.php" class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="customers.php" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="analytics.php" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="settings.php" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <div class="header-search">
                    <form action="search.php" method="GET">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Search..." name="q">
                        </div>
                    </form>
                </div>
                
                <div class="header-actions">
                    <a href="/" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-external-link-alt"></i> View Site
                    </a>
                </div>
            </header>
            
            <div class="admin-content">
                <div class="page-header">
                    <h1 class="page-title">Dashboard</h1>
                    <p class="page-subtitle">Welcome to your admin dashboard</p>
                </div>
                
                <!-- Stats Cards -->
                <div class="row stats-cards">
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="stat-content">
                                    <h2 class="stat-value"><?php echo number_format($totalOrders); ?></h2>
                                    <p class="stat-label">Total Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="stat-content">
                                    <h2 class="stat-value">$<?php echo number_format($totalRevenue, 2); ?></h2>
                                    <p class="stat-label">Total Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <h2 class="stat-value"><?php echo number_format($totalVisits); ?></h2>
                                    <p class="stat-label">Total Visits</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="stat-content">
                                    <h2 class="stat-value">$<?php echo number_format($averageOrderValue, 2); ?></h2>
                                    <p class="stat-label">Avg. Order Value</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card chart-card">
                            <div class="card-header">
                                <h5 class="card-title">Sales & Revenue Overview</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="salesRevenueChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card chart-card">
                            <div class="card-header">
                                <h5 class="card-title">Visits Overview</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="visitsChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Orders & Top Products -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Recent Orders</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $count = 0;
                                            foreach ($recentOrders as $order): 
                                                if ($count >= 5) break;
                                                $count++;
                                                
                                                // Get user
                                                $orderUser = $user->getUserById($order->userId);
                                                $userName = $orderUser ? $orderUser->name : 'Unknown';
                                                
                                                // Format date
                                                $date = date('M d, Y', $order->createdAt->toDateTime()->getTimestamp());
                                            ?>
                                                <tr>
                                                    <td>#<?php echo substr((string)$order->_id, -6); ?></td>
                                                    <td><?php echo htmlspecialchars($userName); ?></td>
                                                    <td>
                                                        <span class="badge rounded-pill bg-<?php 
                                                            echo $order->status === 'completed' ? 'success' : 
                                                                ($order->status === 'pending' ? 'warning' : 
                                                                    ($order->status === 'processing' ? 'info' : 'secondary')); 
                                                        ?>">
                                                            <?php echo ucfirst($order->status); ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $date; ?></td>
                                                    <td>$<?php echo number_format($order->totalPrice, 2); ?></td>
                                                    <td>
                                                        <a href="orders.php?view=<?php echo (string)$order->_id; ?>" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            
                                            <?php if (count($recentOrders) === 0): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No orders found</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <a href="orders.php" class="btn btn-outline-primary">View All Orders</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Top Products</h5>
                            </div>
                            <div class="card-body">
                                <ul class="top-products-list">
                                    <?php foreach ($topProducts as $item): ?>
                                        <li class="product-item">
                                            <div class="product-image">
                                                <img src="<?php echo htmlspecialchars($item['product']->image); ?>" alt="<?php echo htmlspecialchars($item['product']->name); ?>">
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-name"><?php echo htmlspecialchars($item['product']->name); ?></h6>
                                                <div class="product-meta">
                                                    <span class="product-price">$<?php echo number_format($item['product']->price, 2); ?></span>
                                                    <span class="product-views"><?php echo number_format($item['views']); ?> views</span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    
                                    <?php if (count($topProducts) === 0): ?>
                                        <li class="text-center py-4">No product data available</li>
                                    <?php endif; ?>
                                </ul>
                                
                                <div class="text-center mt-3">
                                    <a href="products.php" class="btn btn-outline-primary">Manage Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <footer class="admin-footer">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $siteName; ?>. All Rights Reserved.</p>
            </footer>
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-wrapper').classList.toggle('sidebar-collapsed');
        });
        
        // Chart for Sales & Revenue
        var salesRevenueCtx = document.getElementById('salesRevenueChart').getContext('2d');
        var salesRevenueChart = new Chart(salesRevenueCtx, {
            type: 'bar',
            data: {
                labels: [<?php echo implode(', ', $salesLabels); ?>],
                datasets: [
                    {
                        label: 'Orders',
                        data: [<?php echo implode(', ', $salesData); ?>],
                        backgroundColor: 'rgba(76, 175, 80, 0.4)',
                        borderColor: 'rgba(76, 175, 80, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Revenue',
                        data: [<?php echo implode(', ', $revenueData); ?>],
                        backgroundColor: 'rgba(33, 150, 243, 0.4)',
                        borderColor: 'rgba(33, 150, 243, 1)',
                        borderWidth: 1,
                        type: 'line',
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Orders'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Revenue ($)'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
        
        // Chart for Visits
        var visitsCtx = document.getElementById('visitsChart').getContext('2d');
        var visitsChart = new Chart(visitsCtx, {
            type: 'line',
            data: {
                labels: [<?php echo implode(', ', $visitLabels); ?>],
                datasets: [{
                    label: 'Visits',
                    data: [<?php echo implode(', ', $visitData); ?>],
                    backgroundColor: 'rgba(255, 152, 0, 0.2)',
                    borderColor: 'rgba(255, 152, 0, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(255, 152, 0, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    </script>
</body>
</html> 