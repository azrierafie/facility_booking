<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Approval> $approvals
 */
?>
<div class="index-container">
    <div class="header-actions">
        <h3><?= __('Approvals') ?></h3>
        <?= $this->Html->link(__('New Approval'), ['action' => 'add'], ['class' => 'btn-primary']) ?>
    </div>
    
    <div class="glass-card">
        <div class="table-responsive">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                        <th><?= $this->Paginator->sort('booking_id', 'BOOKING') ?></th>
                        <th><?= $this->Paginator->sort('person_in_charge', 'PERSON IN CHARGE') ?></th>
                        <th><?= $this->Paginator->sort('status', 'STATUS') ?></th>
                        <th><?= $this->Paginator->sort('approved_at', 'APPROVED AT') ?></th>
                        <th class="actions"><?= __('ACTIONS') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($approvals as $approval): ?>
                    <tr>
                        <td><?= $this->Number->format($approval->id) ?></td>
                        <td>
                            <?= $approval->hasValue('booking') ? $this->Html->link(
                                ($approval->booking->user->name ?? 'Unknown User') . ' - ' . ($approval->booking->facility->name ?? 'Unknown Facility'), 
                                ['controller' => 'Bookings', 'action' => 'view', $approval->booking->id]
                            ) : '' ?>
                        </td>
                        <td><?= h($approval->person_in_charge ?: '-') ?></td>
                        <td>
                            <span class="status-badge status-<?= strtolower(h($approval->status)) ?>">
                                <?= h($approval->status) ?>
                            </span>
                        </td>
                        <td><?= h($approval->approved_at) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $approval->id], ['class' => 'btn-action btn-view']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $approval->id], ['class' => 'btn-action btn-edit']) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $approval->id],
                                [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $approval->id),
                                    'class' => 'btn-action btn-delete'
                                ]
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<style>
/* Container & Header */
.index-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.header-actions h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    color: var(--color-text);
}

.btn-primary {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    box-shadow: 0 4px 6px rgba(128, 0, 32, 0.2);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(128, 0, 32, 0.3);
    color: white;
}

/* Glass Card */
.glass-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(226, 232, 240, 0.8);
}

/* Table Styles */
.styled-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 2rem;
}

.styled-table th {
    text-align: left;
    padding: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
    color: #800020;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid #f1f5f9;
}

.styled-table th a {
    color: inherit;
    text-decoration: none;
}

.styled-table td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    color: var(--color-text);
    font-size: 0.9rem;
}

.styled-table tr:last-child td {
    border-bottom: none;
}

.styled-table tr:hover td {
    background-color: #f8fafc;
}

/* Status Badges */
.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-pending {
    background-color: #fef9c3;
    color: #854d0e;
}

.status-approved {
    background-color: #dcfce7;
    color: #166534;
}

.status-rejected {
    background-color: #fee2e2;
    color: #991b1b;
}

/* Action Buttons */
.btn-action {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    margin-right: 0.35rem;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.btn-view {
    background-color: #f1f5f9;
    color: #475569;
}
.btn-view:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}

.btn-edit {
    background-color: #fff7ed;
    color: #ea580c;
}
.btn-edit:hover {
    background-color: #ffedd5;
    color: #c2410c;
}

.btn-delete {
    background-color: #fef2f2;
    color: #dc2626;
}
.btn-delete:hover {
    background-color: #fee2e2;
    color: #b91c1c;
}
</style>