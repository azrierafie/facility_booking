<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $facility_id
 * @property \Cake\I18n\Date $booking_date
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 * @property string|null $purpose
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Facility $facility
 * @property \App\Model\Entity\Approval $approval
 */
class Booking extends Entity
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
        'user_id' => true,
        'facility_id' => true,
        'booking_date' => true,
        'start_time' => true,
        'end_time' => true,
        'purpose' => true,
        'status' => true,
        'created_at' => true,
        'user' => true,
        'facility' => true,
        'approval' => true,
    ];
}
