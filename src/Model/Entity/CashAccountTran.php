<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CashAccountTran Entity
 *
 * @property int $id
 * @property int $store_id
 * @property \Cake\I18n\FrozenTime $transaction_date
 * @property int $cash_account_id
 * @property int $amount
 * @property string $note
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\Account $account
 */
class CashAccountTran extends Entity
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
        'store_id' => true,
        'transaction_date' => true,
        'cash_account_id' => true,
        'amount' => true,
        'note' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'store' => true,
        'account' => true
    ];
}
