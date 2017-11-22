<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesItemHistory Entity
 *
 * @property int $id
 * @property int $sales_item_id
 * @property string $sales_item_name
 * @property \Cake\I18n\FrozenTime $start
 * @property \Cake\I18n\FrozenTime $end
 * @property bool $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\SalesItem $sales_item
 */
class SalesItemHistory extends Entity
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
        'sales_item_id' => true,
        'sales_item_name' => true,
        'start' => true,
        'end' => true,
        'deleted' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'sales_item' => true
    ];
}
