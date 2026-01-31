<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Facility Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $department_id
 * @property int|null $capacity
 * @property string|null $image_url
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Booking[] $bookings
 */
class Facility extends Entity
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
        'name' => true,
        'description' => true,
        'department_id' => true,
        'capacity' => true,
        'image_url' => true,
        'department' => true,
        'bookings' => true,
    ];
}
