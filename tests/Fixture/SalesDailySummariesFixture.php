<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesDailySummariesFixture
 *
 */
class SalesDailySummariesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '売上取引ごとの一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'store_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'どの店舗か', 'precision' => null, 'autoIncrement' => null],
        'transaction_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '取引日', 'precision' => null],
        'cash_sales_amount' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '現金売上', 'precision' => null, 'autoIncrement' => null],
        'sales_amount' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '総売上', 'precision' => null, 'autoIncrement' => null],
        'pasumo_sales_amount' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'パスモ売上', 'precision' => null, 'autoIncrement' => null],
        'early_shift_amount' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '早番（5時から13時まで）売上', 'precision' => null, 'autoIncrement' => null],
        'middle_shift_amount' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '中番（13時から21時まで）売上', 'precision' => null, 'autoIncrement' => null],
        'late_shift_amount' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '遅番（21時から翌5時まで）売上', 'precision' => null, 'autoIncrement' => null],
        'sales_amount_correct' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '総売上修正用', 'precision' => null, 'autoIncrement' => null],
        'pasumo_sales_amount_correct' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'パスモ売上修正用', 'precision' => null, 'autoIncrement' => null],
        'early_shift_amount_correct' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '早番売上修正用', 'precision' => null, 'autoIncrement' => null],
        'middle_shift_amount_correct' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '中番売上修正用', 'precision' => null, 'autoIncrement' => null],
        'late_shift_amount_correct' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '遅番売上修正用', 'precision' => null, 'autoIncrement' => null],
        'note' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '備考', 'precision' => null],
        'vendor_no1_amount' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '１号機券売機の売上', 'precision' => null, 'autoIncrement' => null],
        'vendor_no2_amount' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '２号機券売機の売上', 'precision' => null, 'autoIncrement' => null],
        'amount_7to8' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '時間帯別の売上7時~8時', 'precision' => null, 'autoIncrement' => null],
        'amount_8to9' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_9to10' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_10to11' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_11to12' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_12to13' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_13to14' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_14to15' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_15to16' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_16to17' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_17to18' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_18to19' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_19to20' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_20to21' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_21to22' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_22to23' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_23to24' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_24to1' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_1to2' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_2to3' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_3to4' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_4to5' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_5to6' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_6to7' => ['type' => 'integer', 'length' => 12, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created_by' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'updated_by' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
            'transaction_date' => '2018-01-08',
            'cash_sales_amount' => 1,
            'sales_amount' => 1,
            'pasumo_sales_amount' => 1,
            'early_shift_amount' => 1,
            'middle_shift_amount' => 1,
            'late_shift_amount' => 1,
            'sales_amount_correct' => 1,
            'pasumo_sales_amount_correct' => 1,
            'early_shift_amount_correct' => 1,
            'middle_shift_amount_correct' => 1,
            'late_shift_amount_correct' => 1,
            'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'vendor_no1_amount' => 1,
            'vendor_no2_amount' => 1,
            'amount_7to8' => 1,
            'amount_8to9' => 1,
            'amount_9to10' => 1,
            'amount_10to11' => 1,
            'amount_11to12' => 1,
            'amount_12to13' => 1,
            'amount_13to14' => 1,
            'amount_14to15' => 1,
            'amount_15to16' => 1,
            'amount_16to17' => 1,
            'amount_17to18' => 1,
            'amount_18to19' => 1,
            'amount_19to20' => 1,
            'amount_20to21' => 1,
            'amount_21to22' => 1,
            'amount_22to23' => 1,
            'amount_23to24' => 1,
            'amount_24to1' => 1,
            'amount_1to2' => 1,
            'amount_2to3' => 1,
            'amount_3to4' => 1,
            'amount_4to5' => 1,
            'amount_5to6' => 1,
            'amount_6to7' => 1,
            'created_by' => 1,
            'created_date' => '2018-01-08 18:46:07',
            'updated_by' => 1,
            'updated_date' => '2018-01-08 18:46:07'
        ],
    ];
}
