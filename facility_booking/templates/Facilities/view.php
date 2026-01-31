<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facility $facility
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Book This Facility'), ['controller' => 'Bookings', 'action' => 'add', '?' => ['facility_id' => $facility->id]], ['class' => 'side-nav-item', 'style' => 'background-color: var(--color-primary); color: white; font-weight: bold; text-align: center; margin-bottom: 1rem;']) ?>
            
            <?php 
                $identity = $this->request->getAttribute('identity');
                if ($identity && strtolower($identity->role) === 'admin'): 
            ?>
                <?= $this->Html->link(__('Edit Facility'), ['action' => 'edit', $facility->id], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(__('Delete Facility'), ['action' => 'delete', $facility->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facility->id), 'class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('New Facility'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?php endif; ?>
            
            <?= $this->Html->link(__('List Facilities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="facilities view content">
            <h3><?= h($facility->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($facility->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Department') ?></th>
                    <td><?= $facility->hasValue('department') ? $this->Html->link($facility->department->name, ['controller' => 'Departments', 'action' => 'view', $facility->department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Image Url') ?></th>
                    <td><?= h($facility->image_url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($facility->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Capacity') ?></th>
                    <td><?= $facility->capacity === null ? '' : $this->Number->format($facility->capacity) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($facility->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Bookings') ?></h4>
                <?php if (!empty($facility->bookings)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Booking Date') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Purpose') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($facility->bookings as $booking) : ?>
                        <tr>
                            <td><?= h($booking->id) ?></td>
                            <td><?= h($booking->user_id) ?></td>
                            <td><?= h($booking->booking_date) ?></td>
                            <td><?= h($booking->start_time) ?></td>
                            <td><?= h($booking->end_time) ?></td>
                            <td><?= h($booking->purpose) ?></td>
                            <td><?= h($booking->status) ?></td>
                            <td><?= h($booking->created_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Bookings', 'action' => 'view', $booking->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Bookings', 'action' => 'edit', $booking->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Bookings', 'action' => 'delete', $booking->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $booking->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>