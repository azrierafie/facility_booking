<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Approval Entity
 *
 * @property int $id
 * @property int $booking_id
 * @property int|null $approved_by
 * @property string|null $status
 * @property string|null $notes
 * @property \Cake\I18n\DateTime|null $approved_at
 *
 * @property \App\Model\Entity\Booking $booking
 */
class Approval extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'booking_id' => true,
        'approved_by' => true,
        'person_in_charge' => true,
        'status' => true,
        'notes' => true,
        'approved_at' => true,
        'booking' => true,
    ];
}
