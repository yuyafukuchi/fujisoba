<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesItem Entity
 *
 * @property int $id
 * @property int $sales_item_number
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\SalesItemAssignHistory[] $sales_item_assign_histories
 * @property \App\Model\Entity\SalesItemHistory[] $sales_item_histories
 * @property \App\Model\Entity\SalesItemTransaction[] $sales_item_transactions
 */
class SalesItem extends Entity
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
