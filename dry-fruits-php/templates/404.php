<?php
// Set page title
$pageTitle = 'Page Not Found';

// Set breadcrumbs
$breadcrumbs = [
    'Page Not Found' => false
];
?>

<div class="error-page">
    <div class="container">
        <div class="error-content text-center" data-aos="fade-up">
            <div class="error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h1 class="error-title">404</h1>
            <h2 class="error-subtitle">Page Not Found</h2>
            <p class="error-text">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
            <div class="error-actions">
                <a href="/" class="btn btn-primary">
                    <i class="fas fa-home"></i> Back to Homepage
                </a>
                <a href="/shop" class="btn btn-outline-primary">
                    <i class="fas fa-shopping-cart"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>

<section class="featured-products-section">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">You Might Be Interested In</h2>
            <p class="section-subtitle">Check out these featured products</p>
        </div>
        
        <div class="row">
            <?php
            // Get featured products
            $productModel = new App\Product();
            $featuredProducts = $productModel->getFeaturedProducts(3);
            
            if (empty($featuredProducts)): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No featured products available at the moment. Check back soon!
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($featuredProducts as $index => $product): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="<?php echo htmlspecialchars($product->image); ?>" alt="<?php echo htmlspecialchars($product->name); ?>">
                                <?php if ($product->discountPercentage > 0): ?>
                                    <span class="product-badge sale">-<?php echo (int)$product->discountPercentage; ?>%</span>
                                <?php endif; ?>
                                <div class="product-actions">
                                    <a href="/product/<?php echo (string)$product->_id; ?>" class="action-btn view-btn" title="Quick View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="/cart/add" method="POST" class="action-form">
                                        <input type="hidden" name="product_id" value="<?php echo (string)$product->_id; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="action-btn cart-btn" title="Add to Cart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                    <a href="#" class="action-btn wishlist-btn" title="Add to Wishlist">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title">
                                    <a href="/product/<?php echo (string)$product->_id; ?>"><?php echo htmlspecialchars($product->name); ?></a>
                                </h3>
                                <div class="product-category"><?php echo htmlspecialchars($product->category); ?></div>
                                <div class="product-price">
                                    <?php if ($product->discountPercentage > 0): ?>
                                        <?php 
                                        $discountedPrice = $product->price * (1 - $product->discountPercentage / 100);
                                        ?>
                                        <span class="price-new">$<?php echo number_format($discountedPrice, 2); ?></span>
                                        <span class="price-old">$<?php echo number_format($product->price, 2); ?></span>
                                    <?php else: ?>
                                        <span class="price-new">$<?php echo number_format($product->price, 2); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section> 