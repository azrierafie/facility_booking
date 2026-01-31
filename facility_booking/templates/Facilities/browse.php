<?php
/**
 * Facilities Browse - User View
 * Matches Admin Index Layout for consistency
 * 
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Facility> $facilities
 */
?>
<div class="facilities-browse-page">
    
    <!-- Header -->
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">Browse Facilities</h1>
        <p class="page-subtitle">Find and book the perfect space for your event</p>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <?= $this->Form->create(null, ['type' => 'get', 'class' => 'search-form']) ?>
            <div class="search-inputs">
                <div class="search-input-group">
                    <span class="search-icon">🔍</span>
                    <input 
                        type="text" 
                        name="facility" 
                        placeholder="Search facilities..." 
                        class="search-input"
                        value="<?= h($searchFacility ?? '') ?>"
                    >
                </div>
            </div>
            <div class="search-actions">
                <button type="submit" class="btn-search">Search</button>
                <?php if (!empty($searchFacility)): ?>
                    <a href="<?= $this->Url->build(['action' => 'browse']) ?>" class="btn-clear">Clear</a>
                <?php endif; ?>
            </div>
        <?= $this->Form->end() ?>
    </div>

    <!-- Results Header -->
    <div class="results-header">
        <h2 class="results-count"><?= $this->Paginator->counter(__('{{count}} Results Found')) ?></h2>
    </div>

    <!-- Facilities Grid -->
    <div class="facilities-grid">
        <?php foreach ($facilities as $facility): ?>
        <div class="facility-card">
            <!-- Card Image -->
            <div class="card-image">
                <?php 
                    $nameLower = strtolower($facility->name);
                    if ($nameLower === 'dewan kuliah') {
                        $imgUrl = '/img/dewan_kuliah_v2.jpg';
                    } elseif ($nameLower === 'bilik seminar') {
                        $imgUrl = '/img/bilik_seminar.png';
                    } elseif ($nameLower === 'dewan azman hashim') {
                        $imgUrl = '/img/dewan_azman_hashim.png';
                    } elseif ($nameLower === 'bilik ilmuan 1') {
                        $imgUrl = '/img/bilik_ilmuan_1.png';
                    } elseif ($nameLower === 'bilik ilmuan 2') {
                        $imgUrl = '/img/bilik_ilmuan_2.png';
                    } elseif ($nameLower === 'bilik ilmuan 3') {
                        $imgUrl = '/img/bilik_ilmuan_3.png';
                    } else {
                        $imgUrl = '/img/building_icon.png';
                    }
                ?>
                <img src="<?= $this->Url->build($imgUrl) ?>" alt="<?= h($facility->name) ?>" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <!-- Card Content -->
            <div class="card-content">
                <h3 class="facility-name"><?= h($facility->name) ?></h3>
                
                <div class="amenities">
                    <span class="amenity-tag">📶 Wi-Fi</span>
                    <span class="amenity-tag">📺 Projector</span>
                    <?php if ($facility->capacity): ?>
                        <span class="amenity-tag">👥 <?= h($facility->capacity) ?> People</span>
                    <?php endif; ?>
                </div>

                <p class="facility-desc">
                    <?= h(substr($facility->description ?? 'Professional space suitable for meetings and events.', 0, 100)) ?>...
                </p>

                <!-- Actions -->
                <div class="card-actions">
                    <?= $this->Html->link('Book Now', 
                        ['controller' => 'Bookings', 'action' => 'add', '?' => ['facility_id' => $facility->id]], 
                        ['class' => 'btn-book']) ?>
                    <?= $this->Html->link('Details', 
                        ['action' => 'details', $facility->id], 
                        ['class' => 'btn-details']) ?>
                </div>

                <!-- Upcoming Bookings/Events -->
                <?php if (!empty($facility->bookings) && count($facility->bookings) > 0): ?>
                    <div class="bookings-section">
                        <h4 class="bookings-title">📅 Upcoming Events</h4>
                        <div class="bookings-list">
                            <?php foreach ($facility->bookings as $booking): ?>
                                <div class="booking-item">
                                    <div class="booking-date-time">
                                        <span class="booking-date"><?= h($booking->booking_date->format('M d, Y')) ?></span>
                                        <span class="booking-time"><?= h($booking->start_time->format('g:i A')) ?> - <?= h($booking->end_time->format('g:i A')) ?></span>
                                    </div>
                                    <div class="booking-info">
                                        <?php if ($booking->has('user')): ?>
                                            <span class="booking-user">👤 <?= h($booking->user->name) ?></span>
                                        <?php endif; ?>
                                        <span class="booking-status status-<?= h($booking->status) ?>">
                                            <?= h(ucfirst($booking->status)) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="no-bookings">
                        <span class="no-bookings-text">✨ No upcoming events</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination (White Buttons) -->
    </div>
</div>

<style>
/* Reusing styles from index.php for consistency */

/* Page Header */
.page-title {
    margin: 0 0 0.5rem 0;
    font-size: 2.5rem;
    font-weight: 800;
    color: #1a202c;
    letter-spacing: -0.02em;
}

.page-subtitle {
    margin: 0;
    color: #64748b;
    font-size: 1rem;
}

/* Search Container - New Style */
.search-container {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
}

.search-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.search-inputs {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

/* Light Blue Inputs */
.search-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #bfdbfe; /* Light Blue Border */
    border-radius: 8px;
    font-size: 0.95rem;
    background-color: #e0f2fe; /* Light Blue Background */
    color: #334155;
    font-weight: 500;
}

.search-input::placeholder {
    color: #64748b;
}

.search-input-group {
    position: relative;
}

.search-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1rem;
    color: #0369a1;
}

.search-input-group .search-input {
    padding-left: 2.25rem;
}

.filter-group label {
    display: none; /* Hide labels as per image, relying on placeholder/value */
}

/* Search Actions */
.search-actions {
    display: flex;
    justify-content: flex-start;
    gap: 1rem;
    align-items: center;
}

.btn-search {
    padding: 0.75rem 2.5rem;
    background-color: #991b1b !important; /* Force Maroon */
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.2s;
}

.btn-search:hover {
    background-color: #7f1d1d !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.btn-clear {
    padding: 0.75rem 1.5rem;
    background-color: #f1f5f9;
    color: #64748b;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
    display: inline-block;
}

.btn-clear:hover {
    background-color: #e2e8f0;
    color: #475569;
}

/* Results Header */
.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
}

.results-count {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a202c;
}


/* Facilities Grid matching homepage cards */
.facilities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Reduced to 250px for better mobile grid */
    gap: 1.5rem;
    margin-bottom: 3rem;
    position: relative;
    z-index: 1;
}

/* Facility Card with homepage style */
.facility-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e2e8f0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.facility-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #800020 0%, #a61b3a 100%);
    opacity: 0;
    transition: opacity 0.3s;
}

.facility-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    border-color: #800020;
}

.facility-card:hover::before {
    opacity: 1;
}

/* Card Image */
.card-image {
    position: relative;
    height: 180px;
    overflow: hidden;
}

/* Card Content */
.card-content {
    padding: 1.25rem;
}

.facility-name {
    margin: 0 0 1rem 0;
    font-size: 1.125rem;
    font-weight: 700;
    color: #1a202c;
}

.amenities {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.amenity-tag {
    background: #f1f5f9;
    color: #475569;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    font-size: 0.813rem;
    font-weight: 500;
}

.facility-desc {
    margin: 0 0 1.25rem 0;
    color: #64748b;
    font-size: 0.875rem;
    line-height: 1.5;
}

/* Card Actions */
.card-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
}

.card-actions a {
    padding: 0.625rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.813rem;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-book {
    background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
    color: white;
    grid-column: span 2;
}

.btn-book:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(128, 0, 32, 0.3);
}

.btn-details {
    background: #f1f5f9;
    color: #475569;
    grid-column: span 2; /* Full width for user view since no edit/delete */
}

.btn-details:hover {
    background: #e2e8f0;
}

/* Responsive */
@media (max-width: 768px) {
    .search-inputs {
        grid-template-columns: 1fr;
    }
}

/* Bookings Section */
.bookings-section {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
}

.bookings-title {
    margin: 0 0 0.75rem 0;
    font-size: 0.875rem;
    font-weight: 700;
    color: #1a202c;
}

.bookings-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.booking-item {
    background: #f8fafc;
    padding: 0.75rem;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
}

.booking-date-time {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    margin-bottom: 0.5rem;
}

.booking-date {
    font-size: 0.813rem;
    font-weight: 700;
    color: #1a202c;
}

.booking-time {
    font-size: 0.75rem;
    color: #64748b;
}

.booking-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.5rem;
}

.booking-user {
    font-size: 0.75rem;
    color: #475569;
    font-weight: 500;
}

.booking-status {
    font-size: 0.688rem;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.booking-status.status-pending {
    background-color: #fef3c7;
    color: #92400e;
}

.booking-status.status-approved {
    background-color: #d1fae5;
    color: #065f46;
}

.booking-status.status-rejected {
    background-color: #fee2e2;
    color: #991b1b;
}

.no-bookings {
    margin-top: 1rem;
    padding: 1rem;
    background: #f0fdf4;
    border-radius: 6px;
    text-align: center;
    border: 1px dashed #86efac;
}

.no-bookings-text {
    font-size: 0.813rem;
    color: #166534;
    font-weight: 600;
}
</style>