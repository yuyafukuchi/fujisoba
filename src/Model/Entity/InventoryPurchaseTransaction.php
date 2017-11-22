<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InventoryPurchaseTransaction Entity
 *
 * @property int $id
 * @property int $inventory_item_id
 * @property int $store_id
 * @property \Cake\I18n\FrozenTime $transaction_date
 * @property int $purchase_qty
 * @property int $loss_qty
 * @property int $count_qty
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\InventoryItem $inventory_item
 * @property \App\Model\Entity\Store $store
 */
class InventoryPurchaseTransaction extends Entity
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
        'inventory_item_id' => true,
        'store_id' => true,
        'transaction_date' => true,
        'purchase_qty' => true,
        'loss_qty' => true,
        'count_qty' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'inventory_item' => true,
        'store' => true
    ];
    
    protected function _getHoge()
    {
      return $this->_properties['purchase_qty'] - $this->_properties['loss_qty'] - $this->_properties['count_qty'];;
    }
}
