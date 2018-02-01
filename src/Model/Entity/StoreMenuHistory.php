<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StoreMenuHistory Entity
 *
 * @property int $id
 * @property int $menu_item_id
 * @property int $store_id
 * @property int $store_menu_number
 * @property int $price
 * @property bool $vending_mashine1
 * @property bool $vending_mashine2
 * @property int $sales_item_price
 * @property float $sales_item_cost
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property bool $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\MenuItem $menu_item
 * @property \App\Model\Entity\Store $store
 */
class StoreMenuHistory extends Entity
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
