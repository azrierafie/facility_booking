<?php
/**
 * Dedicated Admin Dashboard Template
 * 
 * @var \App\View\AppView $this
 * @var array $stats
 * @var \Cake\ORM\Query $recentBookings
 * @var \Cake\ORM\Query $recentApprovals
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area - Facility Booking</title>
    <?= $this->Html->meta('icon') ?>
    
    <!-- Stylesheets -->
    <?= $this->Html->css(['dashboard', 'global']) ?>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    

</head>
<body class="dashboard-body">
    <!-- Top Navigation Bar (Same as User Layout) -->
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>">
                <span>Facility</span>Booking
            </a>
        </div>
        <div class="top-nav-links">
            <!-- Admin Navigation -->
            <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>" class="nav-link active">Dashboard</a>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="nav-link">Users</a>
            <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'index']) ?>" class="nav-link">Facilities</a>
            <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" class="nav-link">Bookings</a>
            <a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'index']) ?>" class="nav-link">Departments</a>
            <a href="<?= $this->Url->build(['controller' => 'Approvals', 'action' => 'index']) ?>" class="nav-link">Approvals</a>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="nav-btn">Logout</a>
        </div>
    </nav>

    <div class="dashboard-container">
        
        <!-- Dashboard Header -->
        <header class="dashboard-header">
            <h1 class="dashboard-title">Admin Control Panel</h1>
            <p class="dashboard-subtitle">Welcome back, Administrator.</p>
            <nav class="breadcrumb">
                <a href="<?= $this->Url->build('/') ?>">Home</a>
                <span>›</span>
                <span>Admin Area</span>
            </nav>
        </header>
        
        <!-- Statistics Overview Section -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">System Status</h2>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div class="stat-value"><?= h($stats['totalUsers']) ?></div>
                    <div class="stat-label">Users</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">🏢</div>
                    <div class="stat-value"><?= h($stats['totalFacilities']) ?></div>
                    <div class="stat-label">Facilities</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">📅</div>
                    <div class="stat-value"><?= h($stats['totalBookings']) ?></div>
                    <div class="stat-label">Bookings</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">✅</div>
                    <div class="stat-value"><?= h($stats['pendingApprovals']) ?></div>
                    <div class="stat-label">Pending Reviews</div>
                </div>
            </div>
        </section>
        
        <!-- Entity Management Section -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">Management Tools</h2>
            </div>
            
            <div class="entities-grid">
                <!-- Users Management Card -->
                <div class="entity-card">
                    <div class="entity-header">
                        <div class="entity-icon">👥</div>
                        <div class="entity-info">
                            <h3>User Management</h3>
                            <div class="entity-count">
                                Manage registered users and roles
                            </div>
                        </div>
                    </div>
                    <div class="entity-actions">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="action-btn">
                            <span>Manage Users</span>
                            <span class="action-btn-icon">→</span>
                        </a>
                    </div>
                </div>
                
                <!-- Facilities Management Card -->
                <div class="entity-card">
                    <div class="entity-header">
                        <div class="entity-icon">🏢</div>
                        <div class="entity-info">
                            <h3>Facility Manager</h3>
                            <div class="entity-count">
                                Add or edit rooms and resources
                            </div>
                        </div>
                    </div>
                    <div class="entity-actions">
                        <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'index']) ?>" class="action-btn">
                            <span>Manage Facilities</span>
                            <span class="action-btn-icon">→</span>
                        </a>
                    </div>
                </div>
                
                <!-- Bookings Management Card -->
                <div class="entity-card">
                    <div class="entity-header">
                        <div class="entity-icon">📅</div>
                        <div class="entity-info">
                            <h3>Booking Registry</h3>
                            <div class="entity-count">
                                Oversee all reservation activities
                            </div>
                        </div>
                    </div>
                    <div class="entity-actions">
                        <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" class="action-btn">
                            <span>Manage Bookings</span>
                            <span class="action-btn-icon">→</span>
                        </a>
                    </div>
                </div>
                
            </div>
        </section>
        
    </div>
</body>
</html>
