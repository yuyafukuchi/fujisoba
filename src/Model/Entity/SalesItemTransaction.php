<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesItemTransaction Entity
 *
 * @property int $id
 * @property int $sales_transaction_id
 * @property int $sales_item_id
 * @property int $qty
 * @property int $sales_item_price
 * @property float $sales_item_cost
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\SalesTransaction $sales_transaction
 * @property \App\Model\Entity\SalesItem $sales_item
 */
class SalesItemTransaction extends Entity
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
        'sales_transaction_id' => true,
        'sales_item_id' => true,
        'qty' => true,
        'sales_item_price' => true,
        'sales_item_cost' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'sales_transaction' => true,
        'sales_item' => true
    ];
}
