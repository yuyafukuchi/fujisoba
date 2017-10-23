<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StoresFixture
 *
 */
class StoresFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '店舗ごとの一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'code' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '店舗ごとの一意のコード', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '店舗名', 'precision' => null, 'fixed' => null],
        'company_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'どこの会社に属しているか', 'precision' => null, 'autoIncrement' => null],
        'pay_department_code' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'EPSON給与応援ソフト連携用の店舗部門コード（EPSON給与ソフトの使用要確認）', 'precision' => null, 'fixed' => null],
        'fin_department_code' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'EPSON財務応援で設定している店舗の現金出納借方部門コード（EPSON給与ソフトの使用要確認）', 'precision' => null, 'fixed' => null],
        'start_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '店舗の開始日（0~24の数値）', 'precision' => null],
        'end_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '店舗の終了日（0~24の数値）', 'precision' => null],
        'regular_start_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '通常時給時の開始時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'regular_end_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '通常時給時の終了時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'midnight_start_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '深夜時給時の開始時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'midnight_end_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '深夜時給時の終了時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'other1_start_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'その他1時給時の開始時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'other1_end_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'その他1時給時の終了時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'other2_start_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'その他2時給時の開始時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'other2_end_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'その他2時給時の終了時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'early_start_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '早番の開始時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'early_end_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '早番の終了時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'middle_start_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '中番の開始時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'middle_end_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '中番の終了時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'late_start_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '遅番の開始時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'late_end_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '遅番の終了時間（0~24の数値）', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'データデータ作成日（システム内部使用用）', 'precision' => null],
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
            'name' => 'Lorem ipsum dolor sit amet',
            'company_id' => 1,
            'pay_department_code' => 'Lorem ip',
            'fin_department_code' => 'Lorem ip',
            'start_date' => '2017-10-13 18:36:16',
            'end_date' => '2017-10-13 18:36:16',
            'regular_start_time' => 1,
            'regular_end_time' => 1,
            'midnight_start_time' => 1,
            'midnight_end_time' => 1,
            'other1_start_time' => 1,
            'other1_end_time' => 1,
            'other2_start_time' => 1,
            'other2_end_time' => 1,
            'early_start_time' => 1,
            'early_end_time' => 1,
            'middle_start_time' => 1,
            'middle_end_time' => 1,
            'late_start_time' => 1,
            'late_end_time' => 1,
            'created' => '2017-10-13 18:36:16',
            'created_by' => 1,
            'modified' => '2017-10-13 18:36:16',
            'modified_by' => 1
        ],
    ];
}
