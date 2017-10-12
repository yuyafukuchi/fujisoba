<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesDataInterface Entity
 *
 * @property int $id
 * @property string $status
 * @property string $store_number
 * @property string $vendor_machine_number
 * @property \Cake\I18n\Time $sales_date
 * @property \Cake\I18n\Time $sales_time
 * @property string $account_number
 * @property string $account_name
 * @property int $price
 * @property int $sales_qty
 * @property int $sales_amount
 * @property string $payment_type
 * @property int $p_card_amount
 * @property int $comb_cash_amount
 * @property int $conb_p_card_amount
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 */
class SalesDataInterface extends Entity
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
