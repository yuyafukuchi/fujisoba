<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesItemAssignHistory Entity
 *
 * @property int $id
 * @property int $menu_item_id
 * @property int $sales_item_id
 * @property \Cake\I18n\FrozenTime $start
 * @property \Cake\I18n\FrozenTime $end
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Menu $menu
 * @property \App\Model\Entity\SalesItem $sales_item
 */
class SalesItemAssignHistory extends Entity
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
        'menu_item_id' => true,
        'sales_item_id' => true,
        'start' => true,
        'end' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'menu' => true,
        'sales_item' => true
    ];
}
