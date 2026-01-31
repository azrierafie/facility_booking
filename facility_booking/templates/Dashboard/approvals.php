<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $pendingBookings
 */
?>
<div class="bookings approvals">
    <h3><?= __('Booking Approvals') ?></h3>
    
    <?php if ($pendingBookings->count() > 0): ?>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= __('ID') ?></th>
                        <th><?= __('Facility') ?></th>
                        <th><?= __('Date') ?></th>
                        <th><?= __('Time') ?></th>
                        <th><?= __('User') ?></th>
                        <th><?= __('Department') ?></th>
                        <th><?= __('Purpose') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendingBookings as $booking): ?>
                    <tr>
                        <td><?= $this->Number->format($booking->id) ?></td>
                        <td><?= h($booking->facility->name ?? 'N/A') ?></td>
                        <td><?= h($booking->booking_date ? $booking->booking_date->format('Y-m-d') : 'N/A') ?></td>
                        <td>
                            <?= h($booking->start_time ? $booking->start_time->format('H:i') : 'N/A') ?> -
                            <?= h($booking->end_time ? $booking->end_time->format('H:i') : 'N/A') ?>
                        </td>
                        <td><?= h($booking->user->name ?? 'N/A') ?></td>
                        <td><?= h($booking->user->department->name ?? 'N/A') ?></td>
                        <td><?= h($booking->purpose) ?></td>
                        <td class="actions">
                            <?= $this->Form->postLink(
                                __('Approve'),
                                ['action' => 'approve', $booking->id],
                                [
                                    'confirm' => __('Approve booking for {0}?', $booking->facility->name ?? 'this facility'),
                                    'class' => 'button success'
                                ]
                            ) ?>
                            <?= $this->Form->postLink(
                                __('Reject'),
                                ['action' => 'reject', $booking->id],
                                [
                                    'confirm' => __('Reject booking for {0}?', $booking->facility->name ?? 'this facility'),
                                    'class' => 'button danger'
                                ]
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="empty-message"><?= __('No pending bookings to approve.') ?></p>
    <?php endif; ?>
</div>

<style>
.approvals {
    padding: 2rem;
}

.approvals h3 {
    margin-bottom: 1.5rem;
    color: #333;
}

.table-responsive {
    overflow-x: auto;
}

.approvals table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.approvals th,
.approvals td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

.approvals th {
    background: #f8f9fa;
    font-weight: 600;
    color: #555;
}

.approvals tbody tr:hover {
    background: #f5f5f5;
}

.approvals .actions {
    white-space: nowrap;
}

.approvals .button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 0.5rem;
    text-decoration: none;
    display: inline-block;
    font-size: 0.9rem;
}

.approvals .button.success {
    background: #28a745;
    color: white;
}

.approvals .button.success:hover {
    background: #218838;
}

.approvals .button.danger {
    background: #dc3545;
    color: white;
}

.approvals .button.danger:hover {
    background: #c82333;
}

.empty-message {
    text-align: center;
    padding: 3rem;
    color: #999;
    font-size: 1.1rem;
}
</style>
