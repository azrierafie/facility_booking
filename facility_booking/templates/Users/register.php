<?php
/**
 * Registration Page
 * 
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */
?>
<div class="row" style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <div class="column column-60 column-offset-20">
        <div class="content-card">
            <h2 class="text-center" style="margin-bottom: var(--spacing-lg);">Create Account</h2>
            
            <?= $this->Form->create($user) ?>
            <fieldset>
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('name', [
                            'label' => 'Full Name',
                            'placeholder' => 'John Doe'
                        ]) ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('email', [
                            'label' => 'Email Address',
                            'placeholder' => 'john@example.com'
                        ]) ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('password', [
                            'label' => 'Password',
                            'placeholder' => 'Choose a strong password'
                        ]) ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('phone', [
                            'label' => 'Phone Number',
                            'placeholder' => '+1 234 567 8900'
                        ]) ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('department_id', [
                            'options' => $departments, 
                            'empty' => 'Select Department',
                            'class' => 'u-full-width'
                        ]) ?>
                    </div>
                </div>
            </fieldset>
            
            <div class="text-center" style="margin-top: var(--spacing-md);">
                <?= $this->Form->button(__('Register'), ['class' => 'button', 'style' => 'width: 100%;']) ?>
            </div>
            <?= $this->Form->end() ?>
            
            <div class="text-center" style="margin-top: var(--spacing-lg); color: var(--color-text-secondary);">
                <p>Already have an account? <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Login here</a></p>
            </div>
        </div>
    </div>
</div>
