<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AccountsFixture
 *
 */
class AccountsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '勘定科目の一意のID（システム内部使用用）', 'autoIncrement' => true, 'precision' => null],
        'code' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勘定科目のコード', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '納勘定科目名', 'precision' => null, 'fixed' => null],
        'debit_tax_code' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勘定科目ごとの借方消費税コード(未使用になる可能性あり)', 'precision' => null, 'fixed' => null],
        'debit_found_class' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勘定科目ごとの借方資金区分(未使用になる可能性あり)', 'precision' => null, 'fixed' => null],
        'credit_tax_code' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勘定科目ごとの貸方消費税コード(未使用になる可能性あり)', 'precision' => null, 'fixed' => null],
        'credit_found_class' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '勘定科目ごとの貸方資金区分(未使用になる可能性あり)', 'precision' => null, 'fixed' => null],
        'cash_account' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '現金出納用勘定科目かどうか', 'precision' => null],
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
            'name' => 'Lorem ipsum dolor sit amet',
            'debit_tax_code' => 'Lorem ip',
            'debit_found_class' => 'Lorem ip',
            'credit_tax_code' => 'Lorem ip',
            'credit_found_class' => 'Lorem ip',
            'cash_account' => 1,
            'created' => '2017-10-29 08:37:38',
            'created_by' => 1,
            'modified' => '2017-10-29 08:37:38',
            'modified_by' => 1
        ],
    ];
}
