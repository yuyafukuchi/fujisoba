<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesTransactionsFixture
 *
 */
class SalesTransactionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '売上取引ごとの一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'store_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'どの店舗か', 'precision' => null, 'autoIncrement' => null],
        'transaction_date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '(YYYY/MM/DD/H24:MIN:SS)', 'precision' => null],
        'menu_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'システムのマスタメニューID（システムに未登録の番号があるケースがある)', 'precision' => null, 'autoIncrement' => null],
        'menu_number' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '券売機メニュー番号', 'precision' => null, 'autoIncrement' => null],
        'menu_name' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '券売機メニュー名', 'precision' => null, 'fixed' => null],
        'qty' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '数量', 'precision' => null, 'autoIncrement' => null],
        'cash_sales_amount' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '現金売上', 'precision' => null, 'autoIncrement' => null],
        'pasmo_sales_amount' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'パスモ売上', 'precision' => null, 'autoIncrement' => null],
        'sales_amount' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '総売上', 'precision' => null, 'autoIncrement' => null],
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
            'store_id' => 1,
            'transaction_date' => '2017-11-08 07:38:04',
            'menu_id' => 1,
            'menu_number' => 1,
            'menu_name' => 'Lorem ipsum dolor sit amet',
            'qty' => 1,
            'cash_sales_amount' => 1,
            'pasmo_sales_amount' => 1,
            'sales_amount' => 1,
            'created' => '2017-11-08 07:38:04',
            'created_by' => 1,
            'modified' => '2017-11-08 07:38:04',
            'modified_by' => 1
        ],
    ];
}
