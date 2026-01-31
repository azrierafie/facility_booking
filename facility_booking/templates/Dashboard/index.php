<?php
/**
 * Admin Dashboard Template
 * Comprehensive dashboard with statistics and CRUD access
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
    <title>Admin Dashboard - Facility Booking</title>
    <meta name="description" content="Admin dashboard for facility booking system management">
    <?= $this->Html->meta('icon') ?>
    
    <!-- Stylesheets -->
    <?= $this->Html->css(['dashboard']) ?>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body class="dashboard-body">
    <div class="dashboard-container">
        
        <!-- Dashboard Header -->
        <header class="dashboard-header">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <p class="dashboard-subtitle">Manage your facility booking system</p>
            <nav class="breadcrumb">
                <a href="<?= $this->Url->build('/') ?>">Home</a>
                <span>›</span>
                <span>Admin Dashboard</span>
            </nav>
        </header>
        
        <!-- Booking Statistics Chart Section -->
        <section class="dashboard-section chart-container-section">
            <div class="section-header">
                <h2 class="section-title">Bookings per Facility</h2>
            </div>
            <div class="chart-card">
                <div class="chart-wrapper">
                    <canvas id="bookingStatusChart"></canvas>
                </div>
                <div class="chart-legend-custom">
                    <?php 
                    $colors = ['#800020', '#b45309', '#059669', '#0284c7', '#7c3aed', '#db2777', '#4b5563'];
                    foreach ($bookingsPerFacility as $index => $item): 
                        $color = $colors[$index % count($colors)];
                    ?>
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: <?= $color ?>;"></span>
                            <span class="legend-label"><?= h($item->facility_name) ?>: <strong><?= h($item->count) ?></strong></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <style>
            .chart-card {
                background: white;
                border: 1px solid rgba(226, 232, 240, 0.6);
                border-radius: var(--radius-lg);
                padding: var(--spacing-xl);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: var(--spacing-2xl);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
                transition: all var(--transition-base);
                animation: fadeInUp 0.6s ease-out backwards;
            }
            .chart-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 28px rgba(128, 0, 32, 0.08);
            }
            .chart-wrapper {
                position: relative;
                height: 450px; /* Larger chart for full width */
                width: 450px;
            }
            .chart-legend-custom {
                display: grid;
                grid-template-columns: repeat(2, 1fr); /* Two columns for legend */
                gap: var(--spacing-md) var(--spacing-xl);
            }
            .legend-item {
                display: flex;
                align-items: center;
                gap: var(--spacing-sm);
            }
            .legend-color {
                width: 12px;
                height: 12px;
                border-radius: 50%;
            }
            .legend-label {
                font-size: var(--font-size-md);
                color: var(--color-text-secondary);
            }
            .legend-label strong {
                color: var(--color-text);
            }
            @media (max-width: 768px) {
                .chart-card {
                    flex-direction: column;
                    padding: var(--spacing-lg);
                    gap: var(--spacing-lg);
                }
                .chart-wrapper {
                    height: 250px;
                    width: 250px;
                }
            }
        </style>

        <!-- Statistics Overview Section -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">Overview Statistics</h2>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div class="stat-value"><?= h($stats['totalUsers']) ?></div>
                    <div class="stat-label">Total Users</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">🏢</div>
                    <div class="stat-value"><?= h($stats['totalFacilities']) ?></div>
                    <div class="stat-label">Total Facilities</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">📅</div>
                    <div class="stat-value"><?= h($stats['totalBookings']) ?></div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">🗂️</div>
                    <div class="stat-value"><?= h($stats['totalDepartments']) ?></div>
                    <div class="stat-label">Departments</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">⏰</div>
                    <div class="stat-value"><?= h($stats['todayBookings']) ?></div>
                    <div class="stat-label">Today's Bookings</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">⏳</div>
                    <div class="stat-value"><?= h($stats['pendingApprovals']) ?></div>
                    <div class="stat-label">Pending Approvals</div>
                </div>
            </div>
        </section>
        
        <!-- Entity Management Section -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">Manage Entities</h2>
            </div>
            
            <div class="entities-grid">
                <!-- Users Management Card -->
                <div class="entity-card">
                    <div class="entity-header">
                        <div class="entity-icon">👥</div>
                        <div class="entity-info">
                            <h3>Users</h3>
                            <div class="entity-count">
                                <strong><?= h($stats['totalUsers']) ?></strong> users in system
                            </div>
                        </div>
                    </div>
                    <div class="entity-actions">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="action-btn">
                            <span>View All Users</span>
                            <span class="action-btn-icon">→</span>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="action-btn">
                            <span>Add New User</span>
                            <span class="action-btn-icon">+</span>
                        </a>
                    </div>
                </div>
                
                <!-- Facilities Management Card -->
                <div class="entity-card">
                    <div class="entity-header">
                        <div class="entity-icon">🏢</div>
                        <div class="entity-info">
                            <h3>Facilities</h3>
                            <div class="entity-count">
                                <strong><?= h($stats['totalFacilities']) ?></strong> facilities available
                            </div>
                        </div>
                    </div>
                    <div class="entity-actions">
                        <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'index']) ?>" class="action-btn">
                            <span>View All Facilities</span>
                            <span class="action-btn-icon">→</span>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'add']) ?>" class="action-btn">
                            <span>Add New Facility</span>
                            <span class="action-btn-icon">+</span>
                        </a>
                    </div>
                </div>
                
                <!-- Bookings Management Card -->
                <div class="entity-card">
                    <div class="entity-header">
                        <div class="entity-icon">📅</div>
                        <div class="entity-info">
                            <h3>Bookings</h3>
                            <div class="entity-count">
                                <strong><?= h($stats['totalBookings']) ?></strong> total bookings
                            </div>
                        </div>
                    </div>
                    <div class="entity-actions">
                        <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" class="action-btn">
                            <span>View All Bookings</span>
                            <span class="action-btn-icon">→</span>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'add']) ?>" class="action-btn">
                            <span>Create New Booking</span>
                            <span class="action-btn-icon">+</span>
                        </a>
                    </div>
                </div>
                
                <!-- Departments Management Card -->
                <div class="entity-card">
                    <div class="entity-header">
                        <div class="entity-icon">🗂️</div>
                        <div class="entity-info">
                            <h3>Departments</h3>
                            <div class="entity-count">
                                <strong><?= h($stats['totalDepartments']) ?></strong> departments
                            </div>
                        </div>
                    </div>
                    <div class="entity-actions">
                        <a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'index']) ?>" class="action-btn">
                            <span>View All Departments</span>
                            <span class="action-btn-icon">→</span>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'add']) ?>" class="action-btn">
                            <span>Add New Department</span>
                            <span class="action-btn-icon">+</span>
                        </a>
                    </div>
                </div>
                
                <!-- Approvals Management Card -->
                <div class="entity-card">
                    <div class="entity-header">
                        <div class="entity-icon">✓</div>
                        <div class="entity-info">
                            <h3>Approvals</h3>
                            <div class="entity-count">
                                <strong><?= h($stats['pendingApprovals']) ?></strong> pending approvals
                            </div>
                        </div>
                    </div>
                    <div class="entity-actions">
                        <a href="<?= $this->Url->build(['controller' => 'Approvals', 'action' => 'index']) ?>" class="action-btn">
                            <span>View All Approvals</span>
                            <span class="action-btn-icon">→</span>
                        </a>
                        <a href="<?= $this->Url->build(['controller' => 'Approvals', 'action' => 'add']) ?>" class="action-btn">
                            <span>Process Approvals</span>
                            <span class="action-btn-icon">⚡</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Recent Activity Section -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">Recent Activity</h2>
            </div>
            
            <div class="activity-list">
                <?php if ($recentBookings->count() > 0): ?>
                    <?php foreach ($recentBookings as $booking): ?>
                        <div class="activity-item">
                            <div class="activity-icon">📅</div>
                            <div class="activity-content">
                                <div class="activity-title">
                                    New Booking: <?= h($booking->facility->name ?? 'N/A') ?>
                                </div>
                                <div class="activity-details">
                                    <?= h($booking->user->name ?? 'Unknown User') ?> • 
                                    <?= h($booking->booking_date->format('M d, Y')) ?> • 
                                    <?= h($booking->start_time->format('g:i A')) ?> - <?= h($booking->end_time->format('g:i A')) ?>
                                    <?php if ($booking->status): ?>
                                        <span class="status-badge status-<?= h($booking->status) ?>"><?= h($booking->status) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="activity-time">
                                <?= h($booking->created_at->timeAgoInWords()) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="activity-item">
                        <div class="activity-icon">ℹ️</div>
                        <div class="activity-content">
                            <div class="activity-title">No recent bookings</div>
                            <div class="activity-details">Start by creating your first booking</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Quick Actions Section (Optional Additional Features) -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">Quick Actions</h2>
            </div>
            
            <div class="stats-grid">
                <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'add']) ?>" style="text-decoration: none;">
                    <div class="stat-card">
                        <div class="stat-icon">➕</div>
                        <div class="stat-label">Create Booking</div>
                    </div>
                </a>
                
                <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'add']) ?>" style="text-decoration: none;">
                    <div class="stat-card">
                        <div class="stat-icon">🏗️</div>
                        <div class="stat-label">Add Facility</div>
                    </div>
                </a>
                
                <a href="<?= $this->Url->build(['controller' => 'Approvals', 'action' => 'index']) ?>" style="text-decoration: none;">
                    <div class="stat-card">
                        <div class="stat-icon">✅</div>
                        <div class="stat-label">Process Approvals</div>
                    </div>
                </a>
            </div>
        </section>
        
    </div>
    
    <script>
        // Simple animation observer
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
        
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.stat-card, .entity-card, .activity-item, .chart-card');
            animatedElements.forEach(el => observer.observe(el));

            // Initialize Booking Status Chart
            const ctx = document.getElementById('bookingStatusChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [
                        <?php foreach ($bookingsPerFacility as $item): ?>
                            '<?= addslashes(h($item->facility_name)) ?>',
                        <?php endforeach; ?>
                    ],
                    datasets: [{
                        data: [
                            <?php foreach ($bookingsPerFacility as $item): ?>
                                <?= (int)$item->count ?>,
                            <?php endforeach; ?>
                        ],
                        backgroundColor: [
                            '#800020', '#b45309', '#059669', '#0284c7', '#7c3aed', '#db2777', '#4b5563'
                        ],
                        hoverOffset: 30,
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            padding: 15,
                            titleFont: { size: 16 },
                            bodyFont: { size: 14 },
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} bookings (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        });
    </script>
</body>
</html>
