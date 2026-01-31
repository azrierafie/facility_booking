<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $facilities
 */
?>
<div class="booking-form-container">
    <div class="form-card">
        <div class="form-header">
            <h2>Make a Reservation</h2>
            <p>Complete the form below to book a facility.</p>
        </div>

        <?= $this->Form->create($booking, ['class' => 'booking-form']) ?>
            
            <?php
            $identity = $this->request->getAttribute('identity');
            // Only show user selection for Admins
            if ($identity && strtolower($identity->role ?? '') === 'admin'):
            ?>
                <div class="form-group">
                    <label class="form-label">User (Admin Only)</label>
                    <?= $this->Form->control('user_id', [
                        'options' => $users, 
                        'label' => false,
                        'class' => 'form-select'
                    ]) ?>
                </div>
            <?php else: ?>
                <!-- Hidden user_id is handled by controller, but we can show name for confirmation -->
                <div class="form-group info-group">
                    <label class="form-label">Booking For</label>
                    <div class="static-value"><?= h($identity->name ?? 'Current User') ?></div>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label class="form-label">Select Facility</label>
                <?= $this->Form->control('facility_id', [
                    'options' => $facilities, 
                    'label' => false,
                    'class' => 'form-select',
                    'empty' => 'Choose a facility...'
                ]) ?>
            </div>

            <div class="form-row">
                <div class="form-group col-half">
                    <label class="form-label">Date</label>
                    <?= $this->Form->control('booking_date', [
                        'label' => false,
                        'class' => 'form-control',
                        'type' => 'date',
                        'min' => date('Y-m-d')
                    ]) ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-half">
                    <label class="form-label">Start Time</label>
                    <?= $this->Form->control('start_time', [
                        'label' => false,
                        'class' => 'form-control',
                        'type' => 'time'
                    ]) ?>
                </div>
                <div class="form-group col-half">
                    <label class="form-label">End Time</label>
                    <?= $this->Form->control('end_time', [
                        'label' => false,
                        'class' => 'form-control',
                        'type' => 'time'
                    ]) ?>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Purpose of Booking</label>
                <?= $this->Form->control('purpose', [
                    'label' => false,
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => 'E.g., Team Weekly Meeting, Project Review, etc.'
                ]) ?>
            </div>

            <div class="form-actions">
                <?= $this->Form->button(__('Submit Booking Request'), ['class' => 'btn-submit']) ?>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn-cancel">Cancel</a>
            </div>

        <?= $this->Form->end() ?>
    </div>
</div>

<style>
.booking-form-container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.form-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

.form-header {
    background: #f9fafb;
    padding: 1.5rem 2rem;
    border-bottom: 1px solid #e5e7eb;
}

.form-header h2 {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    color: #111827;
}

.form-header p {
    margin: 0;
    color: #6b7280;
    font-size: 0.95rem;
}

.booking-form {
    padding: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    display: block;
    width: 100%;
    padding: 0.625rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #111827;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #4f46e5;
    outline: 0;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.form-row {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.col-half {
    flex: 1;
    min-width: 200px;
}

.info-group .static-value {
    padding: 0.625rem 0;
    color: #111827;
    font-weight: 600;
}

.form-actions {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
    align-items: center;
}

.btn-submit {
    background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(128, 0, 32, 0.2);
    transition: all 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(128, 0, 32, 0.3);
}

.btn-cancel {
    color: #6b7280;
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 500;
}

.btn-cancel:hover {
    text-decoration: underline;
    color: #374151;
}
</style>
