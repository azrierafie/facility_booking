<?php
/**
 * Facility Booking Application Homepage
 * Modern, responsive landing page with glassmorphism design
 * 
 * @var \App\View\AppView $this
 */

// Enable full width layout
$this->assign('title', 'Book Your Perfect Space');
$this->set('fullWidth', true);
?>

<!-- Specific Homepage Styles -->
<!-- Specific Homepage Styles -->
<?= $this->Html->css(['homepage.css?v=' . time()]) ?>

<style>
    /* Override specific homepage body styles if needed, 
       but global layout handles most. 
       We need to ensure homepage-body class effects are applied if possible 
       or move them to a wrapper */
    .hero-section {
        margin-top: -2rem; /* Offset main padding if necessary */
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="homepage-container">
        <div class="hero-content">
            <h1 class="hero-title">The Premium Destination for Facility Booking</h1>
            <p class="hero-subtitle">
                Join thousands of users who trust us for their event space needs. 
                Register today to browse, book, and manage professional facilities with ease.
            </p>
            <div style="display: flex; justify-content: center;">
                <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'add']) ?>" class="hero-cta">
                    <span>Make a Booking</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </div>
</section>
    
    <!-- Features Section -->
    <section class="section">
        <div class="homepage-container">
            <h2 class="section-title">Why Choose Us</h2>
            
            <div class="features-grid">
                <div class="glass-card feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Easy Booking</h3>
                    <p class="feature-description">
                        Simple and intuitive booking process. Reserve your space in minutes with our streamlined system.
                    </p>
                </div>
                
                <div class="glass-card feature-card">
                    <div class="feature-icon">🏢</div>
                    <h3 class="feature-title">Wide Selection</h3>
                    <p class="feature-description">
                        Choose from a diverse range of facilities including conference rooms, event halls, and meeting spaces.
                    </p>
                </div>
                
                <div class="glass-card feature-card">
                    <div class="feature-icon">✓</div>
                    <h3 class="feature-title">Instant Confirmation</h3>
                    <p class="feature-description">
                        Get immediate booking confirmation and manage your reservations in real-time.
                    </p>
                </div>
                
                <div class="glass-card feature-card">
                    <div class="feature-icon">🌟</div>
                    <h3 class="feature-title">24/7 Support</h3>
                    <p class="feature-description">
                        Our dedicated team is always here to help with your booking needs and inquiries.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Quick Actions Section -->
    <section class="section">
        <div class="homepage-container">
            <h2 class="section-title">Get Started</h2>
            
            <div class="actions-grid">
                <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'browse']) ?>" style="text-decoration: none;">
                    <div class="glass-card action-card">
                        <div class="action-icon">🔍</div>
                        <h3 class="action-title">Browse Facilities</h3>
                        <p class="action-description">
                            Explore our complete catalog of available spaces and amenities
                        </p>
                    </div>
                </a>
                
                <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" style="text-decoration: none;">
                    <div class="glass-card action-card">
                        <div class="action-icon">📅</div>
                        <h3 class="action-title">View Bookings</h3>
                        <p class="action-description">
                            Manage and track all your current and upcoming reservations
                        </p>
                    </div>
                </a>
                
                <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'index']) ?>" style="text-decoration: none;">
                    <div class="glass-card action-card">
                        <div class="action-icon">🕒</div>
                        <h3 class="action-title">Check Availability</h3>
                        <p class="action-description">
                            See real-time availability and find the perfect time slot
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Statistics Section -->
    <section class="section">
        <div class="homepage-container">
            <h2 class="section-title">Trusted by Many</h2>
            
            <div class="stats-grid">
                <div class="glass-card stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Facilities</div>
                </div>
                
                <div class="glass-card stat-card">
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                
                <div class="glass-card stat-card">
                    <div class="stat-number">5000+</div>
                    <div class="stat-label">Bookings Completed</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="homepage-footer">
        <div class="homepage-container">
            <!-- Footer Main Content -->
            <div class="footer-content">
                <!-- Company Info -->
                <div class="footer-section">
                    <h3>🏢 Facility Booking</h3>
                    <p style="color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1rem; font-size: 0.9rem;">
                        Professional facility management system for seamless booking experiences.
                    </p>
                    <div style="display: flex; gap: 0.75rem; margin-top: 1rem;">
                        <a href="#" style="color: var(--color-secondary); text-decoration: none; font-size: 1.25rem;">📧</a>
                        <a href="#" style="color: var(--color-secondary); text-decoration: none; font-size: 1.25rem;">📱</a>
                        <a href="#" style="color: var(--color-secondary); text-decoration: none; font-size: 1.25rem;">🌐</a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>">Home</a></li>
                        <li><a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'browse']) ?>">Browse Facilities</a></li>
                        <?php
                        $identity = $this->request->getAttribute('identity');
                        $isAdmin = $identity && strtolower($identity->role ?? '') === 'admin';
                        ?>
                        <li><a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>"><?= $isAdmin ? 'Booking List' : 'My Bookings' ?></a></li>
                        <li><a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>">Dashboard</a></li>
                    </ul>
                </div>
                
                <!-- Resources -->
                <div class="footer-section">
                    <h4>Resources</h4>
                    <ul class="footer-links">
                        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>">Register</a></li>
                        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Login</a></li>
                        <li><a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'index']) ?>">Departments</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <ul class="footer-links">
                       <li>📧 info@facilitybooking.com</li>
                        <li>📞 +1 (234) 567-890</li>
                        <li>📍 Kuala Lumpur, Malaysia</li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>
                    &copy; <?= date('Y') ?> Facility Booking System. All rights reserved.
                </p>
                <div style="display: flex; gap: 1.5rem;">
                    <a href="#" style="color: var(--color-text-secondary);">Privacy Policy</a>
                    <a href="#" style="color: var(--color-text-secondary);">Terms of Service</a>
                    <a href="#top" style="color: var(--color-primary);">↑ Back to Top</a>
                </div>
            </div>
        </div>
    </footer>
    
<script>
    // Simple fade-in animation observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all animated elements
    document.addEventListener('DOMContentLoaded', () => {
        const animatedElements = document.querySelectorAll('.glass-card, .hero-content');
        animatedElements.forEach(el => {
            observer.observe(el);
        });
    });
</script>
