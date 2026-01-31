<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Approval $approval
 * @var string[]|\Cake\Collection\CollectionInterface $bookings
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $approval->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $approval->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Approvals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="approvals form content">
            <?= $this->Form->create($approval) ?>
            <fieldset>
                <legend><?= __('Edit Approval') ?></legend>
                <?php ?>
                <div class="input info-block" style="margin-bottom: 1.5rem;">
                    <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Booking</label>
                    <p style="padding: 0.75rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; margin: 0;">
                        <?php if ($approval->hasValue('booking')): ?>
                            <strong><?= h($approval->booking->user->name ?? 'User') ?></strong> booking for 
                            <strong><?= h($approval->booking->facility->name ?? 'Facility') ?></strong> 
                            on <?= h($approval->booking->booking_date->format('M d, Y')) ?>
                        <?php else: ?>
                            Booking #<?= h($approval->booking_id) ?>
                        <?php endif; ?>
                    </p>
                    <?= $this->Form->hidden('booking_id') ?>
                </div>
                <?php
                    echo $this->Form->control('person_in_charge', [
                        'type' => 'text',
                        'label' => 'Person in Charge',
                        'placeholder' => 'Enter name of person in charge...',
                        'required' => true
                    ]);
                    echo $this->Form->control('status', [
                        'options' => [
                            'pending' => 'Pending',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected'
                        ],
                        'class' => 'form-select',
                        'required' => true
                    ]);
                    echo $this->Form->control('notes', ['required' => true]);
                    echo $this->Form->control('approved_at', ['required' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
