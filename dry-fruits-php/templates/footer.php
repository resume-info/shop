    </main>
    
    <!-- Newsletter -->
    <section class="newsletter-section" data-aos="fade-up">
        <div class="container">
            <div class="newsletter-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="newsletter-content">
                            <h3>Subscribe to our Newsletter</h3>
                            <p>Get the latest updates, offers and special deals delivered directly to your inbox.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="/subscribe" method="POST" class="newsletter-form">
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" placeholder="Your email address" required>
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6" data-aos="fade-right" data-aos-delay="100">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <img src="/assets/images/logo.png" alt="<?php echo $env['site_name']; ?>" class="logo-img">
                            </div>
                            <p class="about-text">We offer premium quality dry fruits sourced directly from the best farms around the world. Our commitment is to provide the freshest and most nutritious dry fruits to our valued customers.</p>
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="footer-widget">
                            <h4 class="widget-title">Quick Links</h4>
                            <ul class="widget-list">
                                <li><a href="/">Home</a></li>
                                <li><a href="/shop">Shop</a></li>
                                <li><a href="/about">About Us</a></li>
                                <li><a href="/contact">Contact</a></li>
                                <li><a href="/blog">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="footer-widget">
                            <h4 class="widget-title">Categories</h4>
                            <ul class="widget-list">
                                <li><a href="/category/almonds">Almonds</a></li>
                                <li><a href="/category/cashews">Cashews</a></li>
                                <li><a href="/category/pistachios">Pistachios</a></li>
                                <li><a href="/category/walnuts">Walnuts</a></li>
                                <li><a href="/category/dates">Dates</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6" data-aos="fade-left" data-aos-delay="400">
                        <div class="footer-widget">
                            <h4 class="widget-title">Contact Info</h4>
                            <ul class="contact-info">
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>123 Dry Fruit Street, Nutville, CA 12345</span>
                                </li>
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <span>+1 (555) 123-4567</span>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <span>info@dryfruitshub.com</span>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <span>Mon - Fri: 9:00 AM - 5:00 PM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright">© <?php echo date('Y'); ?> <?php echo $env['site_name']; ?>. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-methods">
                            <span>We Accept:</span>
                            <img src="/assets/images/payment-methods.png" alt="Payment Methods">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="/assets/js/main.js"></script>
    
    <?php if (isset($extraJs)): ?>
        <?php foreach ($extraJs as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
        
        // Mobile menu toggle
        document.querySelector('.menu-toggle-btn').addEventListener('click', function() {
            document.body.classList.add('mobile-menu-open');
        });
        
        document.querySelector('.close-menu-btn').addEventListener('click', function() {
            document.body.classList.remove('mobile-menu-open');
        });
        
        // Mobile dropdown toggle
        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                this.parentNode.classList.toggle('open');
            });
        });
        
        // Back to top button
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });
        
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html> 