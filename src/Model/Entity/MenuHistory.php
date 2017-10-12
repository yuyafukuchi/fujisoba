<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MenuHistory Entity
 *
 * @property int $id
 * @property int $menu_item_id
 * @property string $name
 * @property \Cake\I18n\Time $start
 * @property \Cake\I18n\Time $end
 * @property bool $deleted
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\MenuItem $menu_item
 */
class MenuHistory extends Entity
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
