<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MonthlyTimeCard Entity
 *
 * @property int $id
 * @property int $employee_id
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime $latest_emboss_day
 * @property bool $finished
 * @property bool $printed
 * @property bool $approved
 * @property bool $csv_exported
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Employee $employee
 */
class MonthlyTimeCard extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => false,
        '*' => true
    ];
}
