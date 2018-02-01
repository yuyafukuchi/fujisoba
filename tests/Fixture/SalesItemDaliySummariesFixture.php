<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesItemDaliySummariesFixture
 *
 */
class SalesItemDaliySummariesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '出庫日計表ごとの一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'store_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'どの店舗か', 'precision' => null, 'autoIncrement' => null],
        'transaction_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '取引日', 'precision' => null],
        'sales_item_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'どの出庫アイテムか', 'precision' => null, 'autoIncrement' => null],
        'qty' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '取引数', 'precision' => null, 'autoIncrement' => null],
        'sales_item_price_sum' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '出庫計算合計金額', 'precision' => null, 'autoIncrement' => null],
        'sales_item_cost_sum' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '出庫アイテム合計原価', 'precision' => null, 'autoIncrement' => null],
        'created_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'updated_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'updated_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'store_id_transaction_date' => ['type' => 'index', 'columns' => ['store_id', 'transaction_date'], 'length' => []],
        ],
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
            'store_id' => 1,
            'transaction_date' => '2018-01-14',
            'sales_item_id' => 1,
            'qty' => 1,
            'sales_item_price_sum' => 1,
            'sales_item_cost_sum' => 1,
            'created_by' => 1,
            'created_date' => '2018-01-14 16:09:19',
            'updated_by' => 1,
            'updated_date' => '2018-01-14 16:09:19'
        ],
    ];
}
