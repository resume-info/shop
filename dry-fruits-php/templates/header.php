<?php
// Get cart count
$cart = new App\Cart();
$cartCount = $cart->getTotalItems();

// Get current user
$user = new App\User();
$isLoggedIn = $user->isLoggedIn();
$isAdmin = $user->isAdmin();

// Get environment variables for site settings
$env = require_once __DIR__ . '/../config/env.php';
$siteName = $env['site_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . $siteName : $siteName; ?></title>
    
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
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <?php if (isset($extraCss)): ?>
        <?php foreach ($extraCss as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div class="announcement-bar" data-aos="fade-down">
            <div class="container">
                <p>Free shipping on orders over $50! Use code: FREEDRYFRUIT</p>
            </div>
        </div>
        
        <div class="main-header">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo" data-aos="fade-right">
                        <a href="/">
                            <img src="/assets/images/logo.png" alt="<?php echo $siteName; ?>" class="logo-img">
                        </a>
                    </div>
                    
                    <div class="search-box" data-aos="fade-up">
                        <form action="/search" method="GET">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search for dry fruits...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="header-actions" data-aos="fade-left">
                        <div class="action-item">
                            <?php if ($isLoggedIn): ?>
                                <a href="/account" class="action-link">
                                    <i class="fas fa-user"></i>
                                    <span>Account</span>
                                </a>
                            <?php else: ?>
                                <a href="/login" class="action-link">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Login</span>
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="action-item">
                            <a href="/cart" class="action-link cart-link">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Cart</span>
                                <?php if ($cartCount > 0): ?>
                                    <span class="cart-count"><?php echo $cartCount; ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <?php if ($isAdmin): ?>
                            <div class="action-item">
                                <a href="/admin" class="action-link admin-link">
                                    <i class="fas fa-cog"></i>
                                    <span>Admin</span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="main-nav" data-aos="fade-up">
            <div class="container">
                <ul class="nav-list">
                    <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="/shop" class="nav-link">Shop All</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle">Categories</a>
                        <ul class="dropdown-menu">
                            <li><a href="/category/almonds" class="dropdown-item">Almonds</a></li>
                            <li><a href="/category/cashews" class="dropdown-item">Cashews</a></li>
                            <li><a href="/category/pistachios" class="dropdown-item">Pistachios</a></li>
                            <li><a href="/category/walnuts" class="dropdown-item">Walnuts</a></li>
                            <li><a href="/category/dates" class="dropdown-item">Dates</a></li>
                            <li><a href="/category/mixed-dry-fruits" class="dropdown-item">Mixed Dry Fruits</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="/about" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                </ul>
                
                <div class="mobile-menu-toggle">
                    <button type="button" class="menu-toggle-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu">
        <div class="mobile-menu-header">
            <div class="logo">
                <a href="/">
                    <img src="/assets/images/logo.png" alt="<?php echo $siteName; ?>" class="logo-img">
                </a>
            </div>
            <button type="button" class="close-menu-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-search">
            <form action="/search" method="GET">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search for dry fruits...">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        
        <ul class="mobile-nav-list">
            <li class="mobile-nav-item"><a href="/" class="mobile-nav-link">Home</a></li>
            <li class="mobile-nav-item"><a href="/shop" class="mobile-nav-link">Shop All</a></li>
            <li class="mobile-nav-item mobile-dropdown">
                <a href="#" class="mobile-nav-link mobile-dropdown-toggle">Categories</a>
                <ul class="mobile-dropdown-menu">
                    <li><a href="/category/almonds" class="mobile-dropdown-item">Almonds</a></li>
                    <li><a href="/category/cashews" class="mobile-dropdown-item">Cashews</a></li>
                    <li><a href="/category/pistachios" class="mobile-dropdown-item">Pistachios</a></li>
                    <li><a href="/category/walnuts" class="mobile-dropdown-item">Walnuts</a></li>
                    <li><a href="/category/dates" class="mobile-dropdown-item">Dates</a></li>
                    <li><a href="/category/mixed-dry-fruits" class="mobile-dropdown-item">Mixed Dry Fruits</a></li>
                </ul>
            </li>
            <li class="mobile-nav-item"><a href="/about" class="mobile-nav-link">About Us</a></li>
            <li class="mobile-nav-item"><a href="/contact" class="mobile-nav-link">Contact</a></li>
            
            <?php if ($isLoggedIn): ?>
                <li class="mobile-nav-item"><a href="/account" class="mobile-nav-link">My Account</a></li>
                <li class="mobile-nav-item"><a href="/logout" class="mobile-nav-link">Logout</a></li>
            <?php else: ?>
                <li class="mobile-nav-item"><a href="/login" class="mobile-nav-link">Login</a></li>
                <li class="mobile-nav-item"><a href="/register" class="mobile-nav-link">Register</a></li>
            <?php endif; ?>
            
            <?php if ($isAdmin): ?>
                <li class="mobile-nav-item"><a href="/admin" class="mobile-nav-link admin-link">Admin Panel</a></li>
            <?php endif; ?>
        </ul>
    </div>
    
    <!-- Main Content -->
    <main class="main-content"><?php if (isset($breadcrumbs)): ?>
        <div class="breadcrumbs">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <?php foreach($breadcrumbs as $title => $link): ?>
                            <?php if ($link): ?>
                                <li class="breadcrumb-item"><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
                            <?php else: ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ol>
                </nav>
            </div>
        </div>
    <?php endif; ?> 