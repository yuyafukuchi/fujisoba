<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StoreAccountInfo Entity
 *
 * @property int $id
 * @property int $account_id
 * @property int $store_id
 * @property bool $need_debit_department_code
 * @property bool $need_credit_department_code
 * @property string $debit_category_id
 * @property string $credit_category_id
 * @property string $note
 * @property string $note_monthly
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Account $account
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\DebitCategory $debit_category
 * @property \App\Model\Entity\CreditCategory $credit_category
 */
class StoreAccountInfo extends Entity
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
