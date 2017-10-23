<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name_last
 * @property string $name_first
 * @property string $name_last_kana
 * @property string $name_first_kana
 * @property int $company_id
 * @property int $store_id
 * @property string $contact_type
 * @property \Cake\I18n\Time $joined
 * @property \Cake\I18n\Time $retired
 * @property bool $deleted
 * @property string $note
 * @property bool $flag
 * @property int $regular_amount
 * @property int $midnight_amount
 * @property int $other1_amount
 * @property int $other2_amount
 * @property string $employee_shift
 * @property int $othershift_start
 * @property int $othershift_end
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\TimeCard[] $time_cards
 */
class Employee extends Entity
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
