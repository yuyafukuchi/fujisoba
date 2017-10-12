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
 * @property int $sales_item_cost
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
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
        '*' => true,
        'id' => false
    ];
}
