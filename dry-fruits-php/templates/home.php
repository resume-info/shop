<?php
// Set page title
$pageTitle = 'Home';

// Get featured products
$productModel = new App\Product();
$featuredProducts = $productModel->getFeaturedProducts(6);

// Get product categories
$categories = $productModel->getProductCategories();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-slider">
        <div class="hero-slide">
            <div class="hero-image" style="background-image: url('/assets/images/hero-1.jpg');">
                <div class="container">
                    <div class="hero-content" data-aos="fade-right">
                        <h1 class="hero-title">Premium Quality Dry Fruits</h1>
                        <p class="hero-text">Discover our handpicked selection of fresh and nutritious dry fruits sourced from the best farms around the world.</p>
                        <div class="hero-buttons">
                            <a href="/shop" class="btn btn-primary btn-lg">Shop Now</a>
                            <a href="/about" class="btn btn-outline-light btn-lg">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Free Shipping</h4>
                        <p>On orders over $50</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-redo-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Easy Returns</h4>
                        <p>30-day return policy</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Secure Payment</h4>
                        <p>100% secure checkout</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h4>24/7 Support</h4>
                        <p>Dedicated customer service</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Shop By Category</h2>
            <p class="section-subtitle">Explore our wide range of dry fruits by category</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <a href="/category/almonds" class="category-card">
                    <div class="category-image">
                        <img src="/assets/images/categories/almonds.jpg" alt="Almonds">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Almonds</h3>
                        <span class="category-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <a href="/category/cashews" class="category-card">
                    <div class="category-image">
                        <img src="/assets/images/categories/cashews.jpg" alt="Cashews">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Cashews</h3>
                        <span class="category-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <a href="/category/pistachios" class="category-card">
                    <div class="category-image">
                        <img src="/assets/images/categories/pistachios.jpg" alt="Pistachios">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Pistachios</h3>
                        <span class="category-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <a href="/category/walnuts" class="category-card">
                    <div class="category-image">
                        <img src="/assets/images/categories/walnuts.jpg" alt="Walnuts">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Walnuts</h3>
                        <span class="category-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <a href="/category/dates" class="category-card">
                    <div class="category-image">
                        <img src="/assets/images/categories/dates.jpg" alt="Dates">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Dates</h3>
                        <span class="category-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <a href="/category/mixed-dry-fruits" class="category-card">
                    <div class="category-image">
                        <img src="/assets/images/categories/mixed.jpg" alt="Mixed Dry Fruits">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Mixed Dry Fruits</h3>
                        <span class="category-link">Shop Now <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="products-section">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Discover our most popular and high-quality dry fruits</p>
        </div>
        
        <div class="row">
            <?php if (empty($featuredProducts)): ?>
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
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="/shop" class="btn btn-primary btn-lg">View All Products</a>
        </div>
    </div>
</section>

<!-- Banner Section -->
<section class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="banner-item" style="background-image: url('/assets/images/banner-1.jpg');">
                    <div class="banner-content">
                        <h3 class="banner-title">Healthy Snacking</h3>
                        <p class="banner-text">Discover our premium range of healthy and nutritious dry fruits.</p>
                        <a href="/shop" class="btn btn-light">Shop Now</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="banner-item" style="background-image: url('/assets/images/banner-2.jpg');">
                    <div class="banner-content">
                        <h3 class="banner-title">Gift Packages</h3>
                        <p class="banner-text">Perfect gift packages for your loved ones on special occasions.</p>
                        <a href="/category/gift-boxes" class="btn btn-light">Explore Gifts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-us-section">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Why Choose Us</h2>
            <p class="section-subtitle">We take pride in offering the best quality dry fruits</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="why-us-item">
                    <div class="why-us-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h4 class="why-us-title">100% Natural</h4>
                    <p class="why-us-text">Our dry fruits are 100% natural with no added preservatives or chemicals.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="why-us-item">
                    <div class="why-us-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4 class="why-us-title">Premium Quality</h4>
                    <p class="why-us-text">We source only the highest quality dry fruits from trusted farmers.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="why-us-item">
                    <div class="why-us-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <h4 class="why-us-title">Vacuum Packed</h4>
                    <p class="why-us-text">All our products are vacuum packed to maintain freshness and quality.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="why-us-item">
                    <div class="why-us-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4 class="why-us-title">Health Benefits</h4>
                    <p class="why-us-text">Dry fruits are packed with essential nutrients for a healthy lifestyle.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial-section" style="background-image: url('/assets/images/testimonial-bg.jpg');">
    <div class="container">
        <div class="section-header text-center text-white" data-aos="fade-up">
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Don't just take our word for it - here's what our customers think</p>
        </div>
        
        <div class="testimonial-slider" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p>"The quality of dry fruits I received was exceptional. Fresh, flavorful and packed beautifully. Will definitely order again!"</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="/assets/images/testimonials/user-1.jpg" alt="Sarah Johnson">
                            </div>
                            <div class="author-info">
                                <h5>Sarah Johnson</h5>
                                <span>Regular Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p>"I ordered the mixed dry fruits gift box for my parents, and they loved it! The packaging was elegant and the products were top-notch."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="/assets/images/testimonials/user-2.jpg" alt="Michael Roberts">
                            </div>
                            <div class="author-info">
                                <h5>Michael Roberts</h5>
                                <span>Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p>"I've been buying pistachios from this store for months now. The quality is consistently good, and delivery is always on time!"</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="/assets/images/testimonials/user-3.jpg" alt="Emma Wilson">
                            </div>
                            <div class="author-info">
                                <h5>Emma Wilson</h5>
                                <span>Regular Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Latest Articles</h2>
            <p class="section-subtitle">Read our latest articles about dry fruits and healthy living</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="blog-card">
                    <div class="blog-image">
                        <a href="/blog/health-benefits-of-almonds">
                            <img src="/assets/images/blog/blog-1.jpg" alt="Health Benefits of Almonds">
                        </a>
                        <div class="blog-date">
                            <span class="day">15</span>
                            <span class="month">Jun</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title">
                            <a href="/blog/health-benefits-of-almonds">Health Benefits of Almonds You Should Know</a>
                        </h3>
                        <p class="blog-text">Discover the amazing health benefits of almonds and why they should be part of your daily diet.</p>
                        <a href="/blog/health-benefits-of-almonds" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="blog-card">
                    <div class="blog-image">
                        <a href="/blog/dry-fruits-for-weight-loss">
                            <img src="/assets/images/blog/blog-2.jpg" alt="Dry Fruits for Weight Loss">
                        </a>
                        <div class="blog-date">
                            <span class="day">08</span>
                            <span class="month">Jun</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title">
                            <a href="/blog/dry-fruits-for-weight-loss">How Dry Fruits Can Help You Lose Weight</a>
                        </h3>
                        <p class="blog-text">Learn how incorporating dry fruits into your diet can help you achieve your weight loss goals.</p>
                        <a href="/blog/dry-fruits-for-weight-loss" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="blog-card">
                    <div class="blog-image">
                        <a href="/blog/creative-recipes-with-dry-fruits">
                            <img src="/assets/images/blog/blog-3.jpg" alt="Creative Recipes with Dry Fruits">
                        </a>
                        <div class="blog-date">
                            <span class="day">02</span>
                            <span class="month">Jun</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title">
                            <a href="/blog/creative-recipes-with-dry-fruits">5 Creative Recipes with Dry Fruits</a>
                        </h3>
                        <p class="blog-text">Explore these delicious and creative recipes that incorporate various dry fruits.</p>
                        <a href="/blog/creative-recipes-with-dry-fruits" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Instagram Section -->
<section class="instagram-section">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Follow Us On Instagram</h2>
            <p class="section-subtitle">@dryfruitshub</p>
        </div>
        
        <div class="instagram-gallery" data-aos="fade-up">
            <div class="row g-2">
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.instagram.com/" class="instagram-item" target="_blank">
                        <img src="/assets/images/instagram/insta-1.jpg" alt="Instagram Image">
                        <div class="instagram-overlay">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.instagram.com/" class="instagram-item" target="_blank">
                        <img src="/assets/images/instagram/insta-2.jpg" alt="Instagram Image">
                        <div class="instagram-overlay">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.instagram.com/" class="instagram-item" target="_blank">
                        <img src="/assets/images/instagram/insta-3.jpg" alt="Instagram Image">
                        <div class="instagram-overlay">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.instagram.com/" class="instagram-item" target="_blank">
                        <img src="/assets/images/instagram/insta-4.jpg" alt="Instagram Image">
                        <div class="instagram-overlay">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.instagram.com/" class="instagram-item" target="_blank">
                        <img src="/assets/images/instagram/insta-5.jpg" alt="Instagram Image">
                        <div class="instagram-overlay">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.instagram.com/" class="instagram-item" target="_blank">
                        <img src="/assets/images/instagram/insta-6.jpg" alt="Instagram Image">
                        <div class="instagram-overlay">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> 