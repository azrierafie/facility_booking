<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Approval $approval
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Approval'), ['action' => 'edit', $approval->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Approval'), ['action' => 'delete', $approval->id], ['confirm' => __('Are you sure you want to delete # {0}?', $approval->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Approvals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Approval'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="approvals view content">
            <h3><?= h($approval->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Booking') ?></th>
                    <td><?= $approval->hasValue('booking') ? $this->Html->link($approval->booking->id, ['controller' => 'Bookings', 'action' => 'view', $approval->booking->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($approval->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($approval->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Person In Charge') ?></th>
                    <td><?= h($approval->person_in_charge) ?></td>
                </tr>
                <tr>
                    <th><?= __('Approved At') ?></th>
                    <td><?= h($approval->approved_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($approval->notes)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>