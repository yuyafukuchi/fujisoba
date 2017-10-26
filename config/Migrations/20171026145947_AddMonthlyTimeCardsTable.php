<?php
use Migrations\AbstractMigration;

class AddMonthlyTimeCardsTable extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('companies')
            ->changeColumn('code', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->update();

        $this->table('employees')
            ->changeColumn('code', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->changeColumn('othershift_start', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('othershift_end', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->update();

        $this->table('menus')
            ->changeColumn('menu_number', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('sales_items')
            ->changeColumn('sales_item_number', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->update();

        $this->table('stores')
            ->changeColumn('code', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->changeColumn('regular_start_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('regular_end_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('midnight_start_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('midnight_end_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('other1_start_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('other1_end_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('other2_start_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('other2_end_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('early_start_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('early_end_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('middle_start_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('middle_end_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('late_start_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('late_end_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->update();

        $this->table('users')
            ->changeColumn('code', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->update();

        $this->table('store_menu_histories')
            ->changeColumn('sales_item_price', 'tinyinteger', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->update();

        $this->table('time_cards')
            ->removeColumn('schedules_in_time')
            ->changeColumn('paid_vacation_start_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->changeColumn('paid_vacation_end_time', 'tinyinteger', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->update();

        $this->table('monthly_time_cards')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('employee_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('latest_emboss_day', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('finished', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('printed', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('approved', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('csv_exported', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('deleted', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('time_cards')
            ->addColumn('scheduled_in_time', 'datetime', [
                'after' => 'out_time2',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('companies')
            ->changeColumn('code', 'string', [
                'comment' => '会社ごとの一意のコード',
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->update();

        $this->table('employees')
            ->changeColumn('code', 'string', [
                'comment' => '論理的に従業員コードと会社IDで一意のコードとする（DB制約はなくアプリケーション側で制御する）',
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->changeColumn('othershift_start', 'integer', [
                'comment' => 'その他1時給時の開始時間(0~24の数値)',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('othershift_end', 'integer', [
                'comment' => 'その他1時給時の終了時間(0~24の数値)',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->update();

        $this->table('menus')
            ->changeColumn('menu_number', 'integer', [
                'comment' => 'メニュー番号',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('sales_items')
            ->changeColumn('sales_item_number', 'integer', [
                'comment' => '出庫アイテム番号',
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->update();

        $this->table('stores')
            ->changeColumn('code', 'string', [
                'comment' => '店舗ごとの一意のコード',
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->changeColumn('regular_start_time', 'integer', [
                'comment' => '通常時給時の開始時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('regular_end_time', 'integer', [
                'comment' => '通常時給時の終了時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('midnight_start_time', 'integer', [
                'comment' => '深夜時給時の開始時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('midnight_end_time', 'integer', [
                'comment' => '深夜時給時の終了時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('other1_start_time', 'integer', [
                'comment' => 'その他1時給時の開始時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('other1_end_time', 'integer', [
                'comment' => 'その他1時給時の終了時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('other2_start_time', 'integer', [
                'comment' => 'その他2時給時の開始時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('other2_end_time', 'integer', [
                'comment' => 'その他2時給時の終了時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('early_start_time', 'integer', [
                'comment' => '早番の開始時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('early_end_time', 'integer', [
                'comment' => '早番の終了時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('middle_start_time', 'integer', [
                'comment' => '中番の開始時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('middle_end_time', 'integer', [
                'comment' => '中番の終了時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('late_start_time', 'integer', [
                'comment' => '遅番の開始時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('late_end_time', 'integer', [
                'comment' => '遅番の終了時間（0~24の数値）',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->update();

        $this->table('users')
            ->changeColumn('code', 'string', [
                'comment' => 'ユーザごとの一意のコード',
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->update();

        $this->table('store_menu_histories')
            ->changeColumn('sales_item_price', 'integer', [
                'comment' => '出庫計算額',
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->update();

        $this->table('time_cards')
            ->addColumn('schedules_in_time', 'datetime', [
                'after' => 'out_time2',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->changeColumn('paid_vacation_start_time', 'integer', [
                'comment' => '有給計算用の開始時間(0~24の数値)',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->changeColumn('paid_vacation_end_time', 'integer', [
                'comment' => '有給計算用の終了時間(0~24の数値)',
                'default' => null,
                'length' => 4,
                'null' => true,
            ])
            ->removeColumn('scheduled_in_time')
            ->update();

        $this->dropTable('monthly_time_cards');
    }
}

