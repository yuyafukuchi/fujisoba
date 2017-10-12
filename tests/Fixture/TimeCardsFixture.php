<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TimeCardsFixture
 *
 */
class TimeCardsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'employee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'store_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'in_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'out_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'in_time2' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'out_time2' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'schedules_in_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'scheduled_out_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'work_time' => ['type' => 'decimal', 'length' => 2, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'over_time' => ['type' => 'decimal', 'length' => 2, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'paid_vacation' => ['type' => 'decimal', 'length' => 2, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'paid_vacation_start_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'paid_vacation_end_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'note' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null],
        'attendance_store_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
            'employee_id' => 1,
            'store_id' => 1,
            'date' => '2017-10-02',
            'in_time' => '2017-10-02 20:31:32',
            'out_time' => '2017-10-02 20:31:32',
            'in_time2' => '2017-10-02 20:31:32',
            'out_time2' => '2017-10-02 20:31:32',
            'schedules_in_time' => '2017-10-02 20:31:32',
            'scheduled_out_time' => '2017-10-02 20:31:32',
            'work_time' => 1.5,
            'over_time' => 1.5,
            'paid_vacation' => 1.5,
            'paid_vacation_start_time' => 1,
            'paid_vacation_end_time' => 1,
            'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'attendance_store_id' => 1,
            'created' => '2017-10-02 20:31:32',
            'created_by' => 1,
            'modified' => '2017-10-02 20:31:32',
            'modified_by' => 1
        ],
    ];
}
