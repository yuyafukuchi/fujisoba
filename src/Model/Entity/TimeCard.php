<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TimeCard Entity
 *
 * @property int $id
 * @property int $employee_id
 * @property int $store_id
 * @property \Cake\I18n\Time $date
 * @property \Cake\I18n\Time $in_time
 * @property \Cake\I18n\Time $out_time
 * @property \Cake\I18n\Time $in_time2
 * @property \Cake\I18n\Time $out_time2
 * @property \Cake\I18n\Time $schedules_in_time
 * @property \Cake\I18n\Time $scheduled_out_time
 * @property float $work_time
 * @property float $over_time
 * @property float $paid_vacation
 * @property int $paid_vacation_start_time
 * @property int $paid_vacation_end_time
 * @property string $note
 * @property int $attendance_store_id
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\AttendanceStore $attendance_store
 */
class TimeCard extends Entity
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
        '*' => true,
        'id' => false
    ];
}
