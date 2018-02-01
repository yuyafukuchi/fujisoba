<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesItemDaliySummary Entity
 *
 * @property int $id
 * @property int $store_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property int $sales_item_id
 * @property int $qty
 * @property int $sales_item_price_sum
 * @property int $sales_item_cost_sum
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $created_date
 * @property int $updated_by
 * @property \Cake\I18n\FrozenTime $updated_date
 *
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\SalesItem $sales_item
 */
class SalesItemDaliySummary extends Entity
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
        'sales_item_id' => true,
        'qty' => true,
        'sales_item_price_sum' => true,
        'sales_item_cost_sum' => true,
        'created_by' => true,
        'created_date' => true,
        'updated_by' => true,
        'updated_date' => true,
        'store' => true,
        'sales_item' => true
    ];
}
