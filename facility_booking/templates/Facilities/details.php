<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facility $facility
 * @var iterable<\App\Model\Entity\Booking> $upcomingBookings
 */
?>
<div class="facility-details-container">
    <div class="view-header">
        <div class="back-link">
            <a href="<?= $this->Url->build(['action' => 'browse']) ?>">← Back</a>
        </div>
        <h1><?= h($facility->name) ?></h1>
    </div>

    <div class="facility-content-grid">
        <!-- Left Column: Details -->
        <div class="facility-info-column">
            <div class="facility-image-large">
                <!-- Using actual facility images -->
                <?php if (isset($facility->name) && strtolower($facility->name) === 'bilik seminar'): ?>
                    <img src="<?= $this->Url->build('/img/bilik_seminar.png') ?>" alt="Bilik Seminar" class="facility-photo-large">
                <?php elseif (isset($facility->name) && strtolower($facility->name) === 'dewan kuliah'): ?>
                    <img src="<?= $this->Url->build('/img/dewan_kuliah.png') ?>" alt="Dewan Kuliah" class="facility-photo-large">
                <?php elseif (isset($facility->name) && strtolower($facility->name) === 'dewan azman hashim'): ?>
                    <img src="<?= $this->Url->build('/img/dewan_azman_hashim.png') ?>" alt="Dewan Azman Hashim" class="facility-photo-large">
                <?php elseif (isset($facility->name) && strtolower($facility->name) === 'bilik ilmuan 1'): ?>
                    <img src="<?= $this->Url->build('/img/bilik_ilmuan_1.png') ?>" alt="Bilik Ilmuan 1" class="facility-photo-large">
                <?php elseif (isset($facility->name) && strtolower($facility->name) === 'bilik ilmuan 2'): ?>
                    <img src="<?= $this->Url->build('/img/bilik_ilmuan_2.png') ?>" alt="Bilik Ilmuan 2" class="facility-photo-large">
                <?php elseif (isset($facility->name) && strtolower($facility->name) === 'bilik ilmuan 3'): ?>
                    <img src="<?= $this->Url->build('/img/bilik_ilmuan_3.png') ?>" alt="Bilik Ilmuan 3" class="facility-photo-large">
                <?php else: ?>
                    <div class="placeholder-image">🏢</div>
                <?php endif; ?>
            </div>

            
            <div class="info-card">
                <h3>About this Space</h3>
                <p class="description"><?= h($facility->description ?? 'No description available for this facility.') ?></p>
                
                <div class="specs-grid">
                    <div class="spec-item">
                        <span class="spec-label">Capacity</span>
                        <span class="spec-value"><?= h($facility->capacity ?? 'N/A') ?> People</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Department</span>
                        <span class="spec-value"><?= h($facility->department->name ?? 'General') ?></span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Location</span>
                        <span class="spec-value"><?= h($facility->location ?? 'Main Building') ?></span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'add', '?' => ['facility_id' => $facility->id]]) ?>" class="book-now-btn">
                    Book This Facility
                </a>
            </div>
        </div>
        
        <!-- Right Column: Availability -->
        <div class="availability-column">
            <div class="availability-card">
                <h3>Upcoming Schedule</h3>
                <p class="availability-note">Check these times to avoid conflicts.</p>
                
                <?php if (!empty($upcomingBookings) && count($upcomingBookings) > 0): ?>
                    <div class="bookings-list">
                        <?php foreach ($upcomingBookings as $booking): ?>
                            <div class="booking-item">
                                <div class="booking-date">
                                    <div class="day"><?= $booking->booking_date->format('d') ?></div>
                                    <div class="month"><?= $booking->booking_date->format('M') ?></div>
                                </div>
                                <div class="booking-time">
                                    <span class="time-range">
                                        <?= $booking->start_time->format('g:i A') ?> - <?= $booking->end_time->format('g:i A') ?>
                                    </span>
                                    <span class="status-badge status-<?= h($booking->status) ?>">
                                        <?= h(ucfirst($booking->status)) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-schedule">
                        <div class="empty-icon">📅</div>
                        <p>No upcoming bookings. This facility is free!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.facility-details-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.view-header {
    margin-bottom: 2rem;
}

.back-link a {
    display: inline-block;
    background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.938rem;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(128, 0, 32, 0.3);
    margin-bottom: 1rem;
}

.back-link a:hover {
    background: linear-gradient(135deg, #660019 0%, #800020 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(128, 0, 32, 0.4);
}

.view-header h1 {
    font-size: 2.5rem;
    color: #333;
    margin: 0;
}

.facility-content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
}

@media (max-width: 900px) {
    .facility-content-grid {
        grid-template-columns: 1fr;
    }
}

/* Info Column Styles */
.facility-image-large {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    height: 300px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
    color: white;
    font-size: 5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    overflow: hidden;
}

.facility-photo-large {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-image {
    font-size: 5rem;
}

.info-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
    border: 1px solid #eee;
}

.info-card h3 {
    margin-top: 0;
    color: #333;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 1rem;
    margin-bottom: 1.5rem;
}

.description {
    line-height: 1.6;
    color: #555;
    margin-bottom: 2rem;
}

.specs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

.spec-item {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
}

.spec-label {
    display: block;
    color: #888;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.spec-value {
    display: block;
    color: #333;
    font-weight: 600;
    font-size: 1.1rem;
}

.book-now-btn {
    display: block;
    width: 100%;
    background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
    color: white;
    text-align: center;
    padding: 1rem;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(128, 0, 32, 0.3);
}

.book-now-btn:hover {
    background: linear-gradient(135deg, #660019 0%, #800020 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(128, 0, 32, 0.4);
}

/* Availability Column Styles */
.availability-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    border: 1px solid #eee;
}

.availability-card h3 {
    margin-top: 0;
    color: #333;
    margin-bottom: 0.5rem;
}

.availability-note {
    color: #888;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.booking-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.booking-item:last-child {
    border-bottom: none;
}

.booking-date {
    background: #f0f4ff;
    padding: 0.5rem;
    border-radius: 8px;
    text-align: center;
    min-width: 50px;
    margin-right: 1rem;
    color: #4f46e5;
}

.booking-date .day {
    font-size: 1.2rem;
    font-weight: 700;
}

.booking-date .month {
    font-size: 0.75rem;
    text-transform: uppercase;
}

.booking-time {
    flex: 1;
}

.time-range {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.6rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-approved {
    background: #d1fae5;
    color: #065f46;
}

.status-pending {
    background: #fffbeb;
    color: #92400e;
}

.empty-schedule {
    text-align: center;
    padding: 2rem 0;
    color: #aaa;
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}
</style>
