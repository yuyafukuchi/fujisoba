<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InventoryItem Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\InventoryItemHistory[] $inventory_item_histories
 * @property \App\Model\Entity\InventoryPurchaseTransaction[] $inventory_purchase_transactions
 * @property \App\Model\Entity\StoreInventoryItemHistory[] $store_inventory_item_histories
 */
class InventoryItem extends Entity
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
