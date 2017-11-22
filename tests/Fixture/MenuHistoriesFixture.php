<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MenuHistoriesFixture
 *
 */
class MenuHistoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'マスタメニュー履歴ごとの一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'menu_item_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'メニューID', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'メニュー名', 'precision' => null, 'fixed' => null],
        'start' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)', 'precision' => null],
        'end' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データの有効終了日時', 'precision' => null],
        'deleted' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '削除されたか', 'precision' => null],
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
            'name' => 'Lorem ipsum dolor sit amet',
            'start' => '2017-10-31 19:18:28',
            'end' => '2017-10-31 19:18:28',
            'deleted' => 1,
            'created' => '2017-10-31 19:18:28',
            'created_by' => 1,
            'modified' => '2017-10-31 19:18:28',
            'modified_by' => 1
        ],
    ];
}
