<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StoreInventoryItemHistory Entity
 *
 * @property int $id
 * @property int $inventory_item_id
 * @property int $store_id
 * @property int $price
 * @property float $cost
 * @property \Cake\I18n\FrozenTime $start
 * @property \Cake\I18n\FrozenTime $end
 * @property bool $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\InventoryItem $inventory_item
 * @property \App\Model\Entity\Store $store
 */
class StoreInventoryItemHistory extends Entity
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
        '*' => true
    ];

}
