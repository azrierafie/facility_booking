<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */
?>
<div class="form-container">
    <div class="form-header">
        <h3 class="form-title"><?= __('Add New User') ?></h3>
        <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn-back']) ?>
    </div>

    <div class="glass-card form-content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <div class="form-grid">
                <?= $this->Form->control('name', ['label' => 'Full Name', 'placeholder' => 'e.g. John Doe']) ?>
                <?= $this->Form->control('email', ['label' => 'Email Address', 'placeholder' => 'john@example.com']) ?>
                <?= $this->Form->control('password', ['label' => 'Password', 'placeholder' => '••••••••']) ?>
                <?= $this->Form->control('phone', ['label' => 'Phone Number', 'placeholder' => '0123456789']) ?>
                
                <div class="full-width">
                    <?= $this->Form->control('role', [
                        'options' => ['user' => 'User', 'admin' => 'Admin'],
                        'empty' => 'Select User Role',
                        'required' => true,
                        'class' => 'styled-select'
                    ]) ?>
                </div>

                <div class="full-width">
                    <?= $this->Form->control('department_id', [
                        'options' => $departments, 
                        'empty' => 'Select Department',
                        'class' => 'styled-select'
                    ]) ?>
                </div>
            </div>
        </fieldset>
        
        <div class="form-actions">
            <?= $this->Form->button(__('Create User'), ['class' => 'btn-submit']) ?>
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
    font-family: 'Inter', sans-serif; /* Interactive Font */
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

/* Back Button (Matching Primary Style) */
.btn-back {
    display: inline-block;
    padding: 0.75rem 2rem;
    background: linear-gradient(135deg, #800020 0%, #a61b3a 100%); /* Maroon Gradient */
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
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Soft, floating shadow */
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
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.full-width {
    grid-column: span 2;
}

/* Input Styles - Enforcing Interaction */
.input.text, .input.password, .input.email, .input.tel, .input.select {
    margin-bottom: 0;
}

.form-content label {
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.9rem;
    letter-spacing: 0.01em;
}

/* Submit Button - The Star */
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

/* Responsive */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    .full-width {
        grid-column: span 1;
    }
}
</style>
