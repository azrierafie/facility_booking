<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Approval $approval
 * @var \Cake\Collection\CollectionInterface|string[] $bookings
 */
?>
<div class="form-container">
    <div class="form-header">
        <h3 class="form-title"><?= __('Add New Approval') ?></h3>
        <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn-back']) ?>
    </div>

    <div class="glass-card form-content">
        <?= $this->Form->create($approval) ?>
        <fieldset>
            <div class="form-grid">
                <div class="full-width">
                    <?= $this->Form->control('booking_id', ['options' => $bookings, 'label' => 'Booking', 'class' => 'form-select']) ?>
                </div>
                <div class="full-width">
                    <?= $this->Form->control('person_in_charge', [
                        'label' => 'Person in Charge', 
                        'placeholder' => 'Enter name of person in charge...',
                        'class' => 'form-input',
                        'required' => true
                    ]) ?>
                </div>
                <div class="full-width">
                    <?= $this->Form->control('status', [
                        'label' => 'Status',
                        'options' => ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'],
                        'class' => 'form-select',
                        'required' => true
                    ]) ?>
                </div>
                <div class="full-width">
                    <?= $this->Form->control('notes', ['label' => 'Notes', 'rows' => 3, 'class' => 'form-input', 'required' => true]) ?>
                </div>
                <div class="full-width">
                    <?= $this->Form->control('approved_at', ['label' => 'Approved At', 'type' => 'datetime-local', 'class' => 'form-input', 'required' => true]) ?>
                </div>
            </div>
        </fieldset>
        
        <div class="form-actions">
            <?= $this->Form->button(__('Create Approval'), ['class' => 'btn-submit']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<style>
/* Layout */
.form-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 0 1rem;
    font-family: 'Inter', sans-serif;
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.form-title {
    font-size: 1.75rem;
    font-weight: 800;
    background: linear-gradient(135deg, #800020 0%, #b45309 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin: 0;
    letter-spacing: -0.02em;
}

/* Back Button */
.btn-back {
    display: inline-block;
    padding: 0.75rem 2rem;
    background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 700;
    transition: all 0.3s ease;
    border: none;
    font-size: 0.95rem;
    box-shadow: 0 4px 6px rgba(128, 0, 32, 0.2);
}

.btn-back:hover {
    background: linear-gradient(135deg, #660019 0%, #800020 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(128, 0, 32, 0.3);
}

/* Glass Card */
.glass-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
}

/* Form Styles */
fieldset {
    border: none;
    padding: 0;
    margin-bottom: 2rem;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

.full-width {
    grid-column: span 1;
}

.form-content label {
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.9rem;
    letter-spacing: 0.01em;
}

.form-input, .form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.2s ease;
}

.form-input:focus, .form-select:focus {
    outline: none;
    border-color: #800020;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
}

/* Submit Button */
.btn-submit {
    display: block;
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
    color: white;
    font-size: 1.1rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(128, 0, 32, 0.3);
}

.btn-submit:hover {
    background: linear-gradient(135deg, #660019 0%, #800020 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(128, 0, 32, 0.4);
}

.btn-submit:active {
    transform: translateY(1px);
}
</style>
