<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesDailySummary Entity
 *
 * @property int $id
 * @property int $store_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property int $cash_sales_amount
 * @property int $sales_amount
 * @property int $pasumo_sales_amount
 * @property int $early_shift_amount
 * @property int $middle_shift_amount
 * @property int $late_shift_amount
 * @property int $sales_amount_correct
 * @property int $pasumo_sales_amount_correct
 * @property int $early_shift_amount_correct
 * @property int $middle_shift_amount_correct
 * @property int $late_shift_amount_correct
 * @property string $note
 * @property int $vendor_no1_amount
 * @property int $vendor_no2_amount
 * @property int $amount_7to8
 * @property int $amount_8to9
 * @property int $amount_9to10
 * @property int $amount_10to11
 * @property int $amount_11to12
 * @property int $amount_12to13
 * @property int $amount_13to14
 * @property int $amount_14to15
 * @property int $amount_15to16
 * @property int $amount_16to17
 * @property int $amount_17to18
 * @property int $amount_18to19
 * @property int $amount_19to20
 * @property int $amount_20to21
 * @property int $amount_21to22
 * @property int $amount_22to23
 * @property int $amount_23to24
 * @property int $amount_24to1
 * @property int $amount_1to2
 * @property int $amount_2to3
 * @property int $amount_3to4
 * @property int $amount_4to5
 * @property int $amount_5to6
 * @property int $amount_6to7
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $created_date
 * @property int $updated_by
 * @property \Cake\I18n\FrozenTime $updated_date
 *
 * @property \App\Model\Entity\Store $store
 */
class SalesDailySummary extends Entity
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
        'store_id' => true,
        'transaction_date' => true,
        'cash_sales_amount' => true,
        'sales_amount' => true,
        'pasumo_sales_amount' => true,
        'early_shift_amount' => true,
        'middle_shift_amount' => true,
        'late_shift_amount' => true,
        'sales_amount_correct' => true,
        'pasumo_sales_amount_correct' => true,
        'early_shift_amount_correct' => true,
        'middle_shift_amount_correct' => true,
        'late_shift_amount_correct' => true,
        'note' => true,
        'vendor_no1_amount' => true,
        'vendor_no2_amount' => true,
        'amount_7to8' => true,
        'amount_8to9' => true,
        'amount_9to10' => true,
        'amount_10to11' => true,
        'amount_11to12' => true,
        'amount_12to13' => true,
        'amount_13to14' => true,
        'amount_14to15' => true,
        'amount_15to16' => true,
        'amount_16to17' => true,
        'amount_17to18' => true,
        'amount_18to19' => true,
        'amount_19to20' => true,
        'amount_20to21' => true,
        'amount_21to22' => true,
        'amount_22to23' => true,
        'amount_23to24' => true,
        'amount_24to1' => true,
        'amount_1to2' => true,
        'amount_2to3' => true,
        'amount_3to4' => true,
        'amount_4to5' => true,
        'amount_5to6' => true,
        'amount_6to7' => true,
        'created_by' => true,
        'created_date' => true,
        'updated_by' => true,
        'updated_date' => true,
        'store' => true
    ];
}
