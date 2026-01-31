<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="form-container">
    <div class="form-header">
        <h3 class="form-title"><?= __('Add New Department') ?></h3>
        <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn-back']) ?>
    </div>

    <div class="glass-card form-content">
        <?= $this->Form->create($department) ?>
        <fieldset>
            <div class="form-grid">
                <div class="full-width">
                    <?= $this->Form->control('name', ['label' => 'Department Name', 'placeholder' => 'e.g. Faculty of Engineering', 'class' => 'form-input']) ?>
                </div>
                <div class="full-width">
                    <?= $this->Form->control('description', ['label' => 'Description', 'placeholder' => 'Brief description of the department...', 'rows' => 4, 'class' => 'form-input']) ?>
                </div>
            </div>
        </fieldset>
        
        <div class="form-actions">
            <?= $this->Form->button(__('Create Department'), ['class' => 'btn-submit']) ?>
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
