<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InventoryPurchaseTransactionsFixture
 *
 */
class InventoryPurchaseTransactionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '在庫仕入取引ごとの一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'inventory_item_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '在庫アイテムID', 'precision' => null, 'autoIncrement' => null],
        'store_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'どの店舗でつかわれるか', 'precision' => null, 'autoIncrement' => null],
        'transaction_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '取引日', 'precision' => null],
        'purchase_qty' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '仕入数', 'precision' => null, 'autoIncrement' => null],
        'loss_qty' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'ロス数', 'precision' => null, 'autoIncrement' => null],
        'count_qty' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '残取数', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データ作成日（システム内部使用用）', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'データ作成者（システム内部使用用）', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データ最終更新日（システム内部使用用）', 'precision' => null],
        'modified_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'データ最終更新者（システム内部使用用）', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'inventory_item_id' => 1,
            'store_id' => 1,
            'transaction_date' => '2017-11-01 09:11:39',
            'purchase_qty' => 1,
            'loss_qty' => 1,
            'count_qty' => 1,
            'created' => '2017-11-01 09:11:39',
            'created_by' => 1,
            'modified' => '2017-11-01 09:11:39',
            'modified_by' => 1
        ],
    ];
}
