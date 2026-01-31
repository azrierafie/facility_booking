<?php
/**
 * Facilities List - Admin View
 * 
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Facility> $facilities
 */
?>
<div class="facilities-page">
    
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Facilities</h1>
            <p class="page-subtitle">Manage and view all available facilities</p>
        </div>
        <?= $this->Html->link('+ Add New Facility', ['action' => 'add'], ['class' => 'btn-add']) ?>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <form class="search-form" onsubmit="return false;">
            <div class="search-inputs">
                <div class="search-input-group">
                    <span class="search-icon">🔍</span>
                    <input type="text" placeholder="Search facilities..." class="search-input">
                </div>
                <div class="filter-group">
                    <label>Location</label>
                    <input type="text" placeholder="Kuala Lumpur" value="Kuala Lumpur" class="search-input">
                </div>
                <div class="filter-group">
                    <label>Date</label>
                    <input type="date" value="2026-01-24" class="search-input">
                </div>
            </div>
            <div class="search-actions">
                <button class="btn-search">Search</button>
            </div>
        </form>
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
                    <?= $this->Html->link('Edit', 
                        ['action' => 'edit', $facility->id], 
                        ['class' => 'btn-edit']) ?>
                    <?= $this->Form->postLink('Delete',
                        ['action' => 'delete', $facility->id],
                        [
                            'class' => 'btn-delete',
                            'method' => 'delete',
                            'confirm' => __('Are you sure you want to delete {0}?', $facility->name),
                        ]) ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    </div>
</div>

<style>
/* ... (Existing styles above remain unchanged) ... */

/* Beautiful Pagination matching homepage */
/* Removed old pagination styles */

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
    grid-template-columns: 2fr 1fr 1fr;
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
</style>