<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Account Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $debit_tax_code
 * @property string $debit_found_class
 * @property string $credit_tax_code
 * @property string $credit_found_class
 * @property bool $cash_account
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\StoreAccountInfo[] $store_account_infos
 */
class Account extends Entity
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
        'code' => true,
        'name' => true,
        'debit_tax_code' => true,
        'debit_found_class' => true,
        'credit_tax_code' => true,
        'credit_found_class' => true,
        'cash_account' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'store_account_infos' => true
    ];
}
