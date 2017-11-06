<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StoreMenuHistoriesFixture
 *
 */
class StoreMenuHistoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '店舗メニュー履歴ごとの一意のID（システム内部使用用）', 'precision' => null, 'autoIncrement' => null],
        'menu_item_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'メニューID', 'precision' => null, 'autoIncrement' => null],
        'store_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'どの店舗で使われるか', 'precision' => null, 'autoIncrement' => null],
        'store_menu_number' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '店舗メニュー番号', 'precision' => null, 'autoIncrement' => null],
        'price' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '在庫計算用の価格', 'precision' => null, 'autoIncrement' => null],
        'vending_mashine1' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '販売機1号機', 'precision' => null],
        'vending_mashine2' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '販売機2号機', 'precision' => null],
        'sales_item_price' => ['type' => 'tinyinteger', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '出庫計算額', 'precision' => null],
        'sales_item_cost' => ['type' => 'decimal', 'length' => 2, 'precision' => 1, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '出庫アイテムの原価'],
        'start_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)', 'precision' => null],
        'end_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データの有効終了日時', 'precision' => null],
        'deleted' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '削除されたか', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データ作成日（システム内部使用用）', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'データ作成者（システム内部使用用）', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データ最終更新日（システム内部使用用）', 'precision' => null],
        'modified_by' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'データ最終更新者（システム内部使用用）', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
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
            'menu_item_id' => 1,
            'store_id' => 1,
            'store_menu_number' => 1,
            'price' => 1,
            'vending_mashine1' => 1,
            'vending_mashine2' => 1,
            'sales_item_price' => 1,
            'sales_item_cost' => 1.5,
            'start_date' => '2017-11-06 11:41:10',
            'end_date' => '2017-11-06 11:41:10',
            'deleted' => 1,
            'created' => '2017-11-06 11:41:10',
            'created_by' => 1,
            'modified' => '2017-11-06 11:41:10',
            'modified_by' => 1
        ],
    ];
}
