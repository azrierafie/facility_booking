<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
?>
<?php
$identity = $this->request->getAttribute('identity');
$isAdmin = $identity && strtolower($identity->role ?? '') === 'admin';
?>
<div class="bookings-container">
    <div class="header-actions">
        <h1><?= $isAdmin ? __('Booking List') : __('My Bookings') ?></h1>
        <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn-primary">
             + New Booking
        </a>
    </div>

    <?php if ($bookings->count() > 0): ?>
        <div class="bookings-grid">
            <?php foreach ($bookings as $booking): ?>
                <div class="booking-card">
                    <div class="booking-header">
                        <div class="facility-name">
                            <span class="icon">🏢</span> 
                            <?= $booking->hasValue('facility') ? h($booking->facility->name) : 'Unknown Facility' ?>
                        </div>
                        <div class="status-wrapper">
                            <div class="booking-status status-<?= h($booking->status) ?>">
                                <?= h(ucfirst($booking->status)) ?>
                            </div>
                            <?php if ($booking->status === 'pending'): ?>
                                <div class="pending-remark">⏳ Approval within 5 working days</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="booking-body">
                        <div class="time-block">
                            <div class="date">
                                <?= h($booking->booking_date->format('M d, Y')) ?>
                            </div>
                            <div class="time">
                                <?= h($booking->start_time->format('g:i A')) ?> - <?= h($booking->end_time->format('g:i A')) ?>
                            </div>
                        </div>
                        
                        <div class="purpose-block">
                            <label>Purpose</label>
                            <p><?= h($booking->purpose) ?></p>
                        </div>

                        <?php if ($booking->hasValue('approval') && !empty($booking->approval->person_in_charge)): ?>
                            <div class="pic-block">
                                <label>Person in Charge</label>
                                <p>👤 <?= h($booking->approval->person_in_charge) ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($booking->status === 'rejected' && !empty($booking->approvals)): ?>
                             <?php // Ideally we should fetch the approval note, but for now simplify ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="booking-footer">
                        <span class="created-at">Requested: <?= h($booking->created_at->timeAgoInWords()) ?></span>
                        <div class="actions">
                            <?php if ($booking->status === 'approved'): ?>
                                <?= $this->Html->link('📄 Receipt', ['action' => 'receipt', $booking->id], ['class' => 'btn-link', 'target' => '_blank']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    <?php else: ?>
        <div class="empty-state">
            <div class="empty-icon">📅</div>
            <h3>No bookings found</h3>
            <p>You haven't made any facility bookings yet.</p>
            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn-primary mt-3">
                Make your first booking
            </a>
        </div>
    <?php endif; ?>
</div>

<style>
.bookings-container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.header-actions h1 {
    margin: 0;
    font-size: 2rem;
    color: #1f2937;
}

.bookings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.booking-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
    transition: transform 0.2s;
    display: flex;
    flex-direction: column;
}

.booking-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.booking-header {
    padding: 1.25rem;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background-color: #f8fafc;
}

.facility-name {
    font-weight: 600;
    color: #111827;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.booking-status {
    font-size: 0.75rem;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.status-pending { background-color: #fffbeb; color: #92400e; }
.status-approved { background-color: #d1fae5; color: #065f46; }
.status-rejected { background-color: #fee2e2; color: #991b1b; }

.status-wrapper {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.25rem;
}

.pending-remark {
    font-size: 0.7rem;
    color: #92400e;
    background-color: #fef3c7;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-weight: 500;
}

.booking-body {
    padding: 1.25rem;
    flex: 1;
}

.time-block {
    margin-bottom: 1rem;
}

.time-block .date {
    font-size: 1.1rem;
    font-weight: 700;
    color: #374151;
}

.time-block .time {
    color: #6b7280;
    font-size: 0.95rem;
}

.purpose-block label, .pic-block label {
    display: block;
    font-size: 0.75rem;
    text-transform: uppercase;
    color: #9ca3af;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.purpose-block p, .pic-block p {
    margin: 0;
    color: #4b5563;
    font-size: 0.95rem;
    line-height: 1.5;
}

.pic-block {
    margin-top: 1rem;
    padding-top: 0.75rem;
    border-top: 1px dashed #e5e7eb;
}

.booking-footer {
    padding: 1rem 1.25rem;
    background-color: #f9fafb;
    border-top: 1px solid #f3f4f6;
    border-radius: 0 0 12px 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.created-at {
    font-size: 0.8rem;
    color: #9ca3af;
}

.actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.btn-link {
    text-decoration: none;
    font-size: 0.9rem;
    color: #800020; /* MAROON */
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.text-danger {
    color: #dc2626;
}

.btn-link:hover {
    text-decoration: underline;
    opacity: 0.8;
}

.btn-primary {
    background-color: #800020; /* MAROON */
    color: white;
    padding: 0.6rem 1.2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.2s;
    display: inline-block;
}

.btn-primary:hover {
    background-color: #660019; /* Dark Maroon */
}

.mt-3 { margin-top: 1rem; }

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 12px;
    border: 2px dashed #e5e7eb;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state h3 {
    margin: 0 0 0.5rem 0;
    color: #374151;
}

.empty-state p {
    color: #6b7280;
    margin: 0;
}
</style>