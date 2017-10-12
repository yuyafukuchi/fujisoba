<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Store Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $company_id
 * @property string $pay_department_code
 * @property string $fin_department_code
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property int $regular_start_time
 * @property int $regular_end_time
 * @property int $midnight_start_time
 * @property int $midnight_end_time
 * @property int $other1_start_time
 * @property int $other1_end_time
 * @property int $other2_start_time
 * @property int $other2_end_time
 * @property int $early_start_time
 * @property int $early_end_time
 * @property int $middle_start_time
 * @property int $middle_end_time
 * @property int $late_start_time
 * @property int $late_end_time
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\CashAccountTran[] $cash_account_trans
 * @property \App\Model\Entity\Employee[] $employees
 * @property \App\Model\Entity\InventoryPurchaseTransaction[] $inventory_purchase_transactions
 * @property \App\Model\Entity\SalesTransaction[] $sales_transactions
 * @property \App\Model\Entity\StoreAccountInfo[] $store_account_infos
 * @property \App\Model\Entity\StoreInventoryItemHistory[] $store_inventory_item_histories
 * @property \App\Model\Entity\TimeCard[] $time_cards
 * @property \App\Model\Entity\User[] $users
 */
class Store extends Entity
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
