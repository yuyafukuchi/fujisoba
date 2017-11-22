<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesItemAssignHistoriesFixture
 *
 */
class SalesItemAssignHistoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '出庫アイテム割付ごとの一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'menu_item_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'メニューID', 'precision' => null, 'autoIncrement' => null],
        'sales_item_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '出庫アイテムID(メニューに割り付けられる出庫アイテムID)', 'precision' => null, 'autoIncrement' => null],
        'start' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)', 'precision' => null],
        'end' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データの有効終了日時', 'precision' => null],
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
            'menu_item_id' => 1,
            'sales_item_id' => 1,
            'start' => '2017-11-07 18:31:42',
            'end' => '2017-11-07 18:31:42',
            'created' => '2017-11-07 18:31:42',
            'created_by' => 1,
            'modified' => '2017-11-07 18:31:42',
            'modified_by' => 1
        ],
    ];
}
