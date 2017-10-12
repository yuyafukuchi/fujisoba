<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesTransaction Entity
 *
 * @property int $id
 * @property int $store_id
 * @property \Cake\I18n\Time $transaction_data
 * @property int $menu_id
 * @property int $menu_number
 * @property string $menu_name
 * @property int $qty
 * @property int $cash_sales_amount
 * @property int $pasmo_sales_amount
 * @property int $sales_amount
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\Menu $menu
 * @property \App\Model\Entity\SalesItemTransaction[] $sales_item_transactions
 */
class SalesTransaction extends Entity
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
