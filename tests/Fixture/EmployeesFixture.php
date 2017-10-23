<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeesFixture
 *
 */
class EmployeesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '従業員ごとの一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'code' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '論理的に従業員コードと会社IDで一意のコードとする（DB制約はなくアプリケーション側で制御する）', 'precision' => null, 'fixed' => null],
        'name_last' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '従業員名:姓', 'precision' => null, 'fixed' => null],
        'name_first' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '従業員名:名', 'precision' => null, 'fixed' => null],
        'name_last_kana' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '従業員名:姓カナ', 'precision' => null, 'fixed' => null],
        'name_first_kana' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '従業員名:名カナ', 'precision' => null, 'fixed' => null],
        'company_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'どこの会社に属しているか、従業員コードと会社IDで一意のコード', 'precision' => null, 'autoIncrement' => null],
        'store_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'どこの店舗に属しているか', 'precision' => null, 'autoIncrement' => null],
        'contact_type' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '従業員の契約種別(P:正社員、C:契約社員、A:アルバイト)', 'precision' => null, 'fixed' => null],
        'joined' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'retired' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '論理削除されたか', 'precision' => null],
        'note' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null],
        'flag' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '店長やその他社員かどうか(社員である場合は、給与ソフトとの連動対象外となる)', 'precision' => null],
        'regular_amount' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '時給:通常', 'precision' => null, 'autoIncrement' => null],
        'midnight_amount' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '時給:深夜', 'precision' => null, 'autoIncrement' => null],
        'other1_amount' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '時給:その他1', 'precision' => null, 'autoIncrement' => null],
        'other2_amount' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '時給:その他2', 'precision' => null, 'autoIncrement' => null],
        'employee_shift' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'シフト(E:早番、M:中番、L:遅番、O:その他)', 'precision' => null, 'fixed' => null],
        'othershift_start' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'その他1時給時の開始時間(0~24の数値)', 'precision' => null, 'autoIncrement' => null],
        'othershift_end' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'その他1時給時の終了時間(0~24の数値)', 'precision' => null, 'autoIncrement' => null],
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
            'code' => 'Lorem ip',
            'name_last' => 'Lorem ipsum dolor sit amet',
            'name_first' => 'Lorem ipsum dolor sit amet',
            'name_last_kana' => 'Lorem ipsum dolor sit amet',
            'name_first_kana' => 'Lorem ipsum dolor sit amet',
            'company_id' => 1,
            'store_id' => 1,
            'contact_type' => 'Lorem ip',
            'joined' => '2017-10-13 18:36:58',
            'retired' => '2017-10-13 18:36:58',
            'deleted' => 1,
            'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'flag' => 1,
            'regular_amount' => 1,
            'midnight_amount' => 1,
            'other1_amount' => 1,
            'other2_amount' => 1,
            'employee_shift' => 'Lorem ip',
            'othershift_start' => 1,
            'othershift_end' => 1,
            'created' => '2017-10-13 18:36:58',
            'created_by' => 1,
            'modified' => '2017-10-13 18:36:58',
            'modified_by' => 1
        ],
    ];
}
