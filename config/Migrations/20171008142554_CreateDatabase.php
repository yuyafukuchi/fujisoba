<?php
use Migrations\AbstractMigration;

class CreateDatabase extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('accounts')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '勘定科目の一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('code', 'string', [
                'comment' => '勘定科目のコード',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'comment' => '納勘定科目名',
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('debit_tax_code', 'string', [
                'comment' => '勘定科目ごとの借方消費税コード(未使用になる可能性あり)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('debit_found_class', 'string', [
                'comment' => '勘定科目ごとの借方資金区分(未使用になる可能性あり)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('credit_tax_code', 'string', [
                'comment' => '勘定科目ごとの貸方消費税コード(未使用になる可能性あり)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('credit_found_class', 'string', [
                'comment' => '勘定科目ごとの貸方資金区分(未使用になる可能性あり)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('cash_account', 'boolean', [
                'comment' => '現金出納用勘定科目かどうか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('cash_account_trans')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '現金出納ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('store_id', 'integer', [
                'comment' => 'どこの店舗に属しているか',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('transaction_date', 'datetime', [
                'comment' => '取引日',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('cash_account_id', 'integer', [
                'comment' => '現金出納用の勘定科目ID',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('amount', 'integer', [
                'comment' => '出納額',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('note', 'text', [
                'comment' => '内訳',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('companies')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '会社ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('code', 'string', [
                'comment' => '会社ごとの一意のコード',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'comment' => '会社名',
                'default' => null,
                'limit' => 60,
                'null' => false,
            ])
            ->addColumn('start_date', 'datetime', [
                'comment' => '会社の開始日',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end_date', 'datetime', [
                'comment' => '会社の終了日',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('employees')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '従業員ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('code', 'string', [
                'comment' => '論理的に従業員コードと会社IDで一意のコードとする（DB制約はなくアプリケーション側で制御する）',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('name_last', 'string', [
                'comment' => '従業員名:姓',
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('name_first', 'string', [
                'comment' => '従業員名:名',
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('name_last_kana', 'string', [
                'comment' => '従業員名:姓カナ',
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('name_first_kana', 'string', [
                'comment' => '従業員名:名カナ',
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'どこの会社に属しているか、従業員コードと会社IDで一意のコード',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('store_id', 'integer', [
                'comment' => 'どこの店舗に属しているか',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('contact_type', 'string', [
                'comment' => '従業員の契約種別(P:正社員、C:契約社員、A:アルバイト)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('joined', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('retired', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'boolean', [
                'comment' => '論理削除されたか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('note', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('flag', 'boolean', [
                'comment' => '店長やその他社員かどうか(社員である場合は、給与ソフトとの連動対象外となる)',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('regular_amount', 'integer', [
                'comment' => '時給:通常',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('midnight_amount', 'integer', [
                'comment' => '時給:深夜',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('other1_amount', 'integer', [
                'comment' => '時給:その他1',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('other2_amount', 'integer', [
                'comment' => '時給:その他2',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('employee_shift', 'string', [
                'comment' => 'シフト(E:早番、M:中番、L:遅番、O:その他)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('othershift_start', 'integer', [
                'comment' => 'その他1時給時の開始時間(0~24の数値)',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('othershift_end', 'integer', [
                'comment' => 'その他1時給時の終了時間(0~24の数値)',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('inventory_item_histories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '在庫アイテム履歴ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('inventory_item_id', 'integer', [
                'comment' => '在庫アイテムID',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('item_name', 'string', [
                'comment' => '在庫アイテム名',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('start', 'datetime', [
                'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end', 'datetime', [
                'comment' => 'データの有効終了日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'boolean', [
                'comment' => '削除されたか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('inventory_items')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '在庫アイテムごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('inventory_purchase_transactions')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '在庫仕入取引ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('inventory_item_id', 'integer', [
                'comment' => '在庫アイテムID',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('store_id', 'integer', [
                'comment' => 'どの店舗でつかわれるか',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('transaction_date', 'datetime', [
                'comment' => '取引日',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('purchase_qty', 'integer', [
                'comment' => '仕入数',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('loss_qty', 'integer', [
                'comment' => 'ロス数',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('count_qty', 'integer', [
                'comment' => '残取数',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('menu_histories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => 'マスタメニュー履歴ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('menu_item_id', 'integer', [
                'comment' => 'メニューID',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('name', 'string', [
                'comment' => 'メニュー名',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('start', 'datetime', [
                'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end', 'datetime', [
                'comment' => 'データの有効終了日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'boolean', [
                'comment' => '削除されたか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('menus')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => 'メニューごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('menu_number', 'integer', [
                'comment' => 'メニュー番号',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('permit_pcs')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '許可PCごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('ip_address', 'string', [
                'comment' => 'IPアドレス',
                'default' => null,
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('sales_data_interfaces')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '販売データインターフェースごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('status', 'string', [
                'comment' => '処理状況のステータス',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('store_number', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('vendor_machine_number', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('sales_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('sales_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('account_number', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('account_name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('price', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('sales_qty', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('sales_amount', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('payment_type', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('p_card_amount', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('comb_cash_amount', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('conb_p_card_amount', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('sales_item_assign_histories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '出庫アイテム割付ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('menu_item_id', 'integer', [
                'comment' => 'メニューID',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('sales_item_id', 'integer', [
                'comment' => '出庫アイテムID(メニューに割り付けられる出庫アイテムID)',
                'default' => null,
                'limit' => 10,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('start', 'datetime', [
                'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end', 'datetime', [
                'comment' => 'データの有効終了日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('sales_item_histories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '出庫アイテム履歴ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('sales_item_id', 'integer', [
                'comment' => '出庫アイテムID',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('sales_item_name', 'string', [
                'comment' => '出庫アイテム名',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('start', 'datetime', [
                'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end', 'datetime', [
                'comment' => 'データの有効終了日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'boolean', [
                'comment' => '削除されたか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('sales_item_transactions')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '出庫アイテム取引ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('sales_transaction_id', 'integer', [
                'comment' => 'どの売上取引IDか',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('sales_item_id', 'integer', [
                'comment' => 'どの出庫アイテムか',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('qty', 'integer', [
                'comment' => '取引数',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('sales_item_price', 'integer', [
                'comment' => '出庫計算金額',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('sales_item_cost', 'decimal', [
                'comment' => '出庫アイテム原価',
                'default' => null,
                'null' => true,
                'precision' => 2,
                'scale' => 1,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('sales_items')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '出庫アイテムごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('sales_item_number', 'integer', [
                'comment' => '出庫アイテム番号',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('sales_transactions')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '売上取引ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('store_id', 'integer', [
                'comment' => 'どの店舗か',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('transaction_date', 'datetime', [
                'comment' => '(YYYY/MM/DD/H24:MIN:SS)',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('menu_id', 'integer', [
                'comment' => 'システムのマスタメニューID（システムに未登録の番号があるケースがある)',
                'default' => null,
                'limit' => 10,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('menu_number', 'integer', [
                'comment' => '券売機メニュー番号',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('menu_name', 'string', [
                'comment' => '券売機メニュー名',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('qty', 'integer', [
                'comment' => '数量',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cash_sales_amount', 'integer', [
                'comment' => '現金売上',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('pasmo_sales_amount', 'integer', [
                'comment' => 'パスモ売上',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('sales_amount', 'integer', [
                'comment' => '総売上',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('store_account_infos')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '勘定科目の一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('account_id', 'integer', [
                'comment' => '勘定科目ID',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('store_id', 'integer', [
                'comment' => '店舗ID',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('need_debit_department_code', 'boolean', [
                'comment' => '借方に部門コードが必要かどうか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('need_credit_department_code', 'boolean', [
                'comment' => '貸方に部門コードが必要かどうか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('debit_category_id', 'string', [
                'comment' => 'EPSON財務応援で設定している店舗の各科目ごとの借方補助コード(EPSON税務応援で設定の必要がなければ入力しない)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('credit_category_id', 'string', [
                'comment' => 'EPSON財務応援で設定している店舗の各科目ごとの貸方補助コード(EPSON税務応援で設定の必要がなければ入力しない)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('note', 'text', [
                'comment' => 'EPSON財務応援の仕訳用の店舗・科目ごとの1日ごと用の摘要(摘要＋現金出納の内訳で入力された文言を使用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('note_monthly', 'text', [
                'comment' => 'EPSON財務応援の仕訳用の店舗・科目ごとの1ヶ月の合計用の摘要(「○○店　【科目名】　○○月分」の様に入力)',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('store_inventory_item_histories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '店舗在庫アイテム履歴ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('inventory_item_id', 'integer', [
                'comment' => '在庫アイテムID',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('store_id', 'integer', [
                'comment' => 'どの店舗でつかわれるか',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('price', 'integer', [
                'comment' => '在庫計算用の価格',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cost', 'decimal', [
                'comment' => '在庫アイテムの原価',
                'default' => null,
                'null' => true,
                'precision' => 2,
                'scale' => 1,
            ])
            ->addColumn('start', 'datetime', [
                'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end', 'datetime', [
                'comment' => 'データの有効終了日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'boolean', [
                'comment' => '削除されたか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('store_menu_histories')
            ->addColumn('id', 'integer', [
                'comment' => '店舗メニュー履歴ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('menu_item_id', 'integer', [
                'comment' => 'メニューID',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('store_id', 'integer', [
                'comment' => 'どの店舗で使われるか',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('store_menu_number', 'integer', [
                'comment' => '店舗メニュー番号',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('price', 'integer', [
                'comment' => '在庫計算用の価格',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('vending_mashine1', 'boolean', [
                'comment' => '販売機1号機',
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('vending_mashine2', 'boolean', [
                'comment' => '販売機2号機',
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('sales_item_price', 'integer', [
                'comment' => '出庫計算額',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('sales_item_cost', 'decimal', [
                'comment' => '出庫アイテムの原価',
                'default' => null,
                'null' => true,
                'precision' => 2,
                'scale' => 1,
            ])
            ->addColumn('start_date', 'datetime', [
                'comment' => 'データの有効開始日時(画面からは開始日（設定日）のみ入力される)',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end_date', 'datetime', [
                'comment' => 'データの有効終了日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'boolean', [
                'comment' => '削除されたか',
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->create();

        $this->table('stores')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => '店舗ごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('code', 'string', [
                'comment' => '店舗ごとの一意のコード',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'comment' => '店舗名',
                'default' => null,
                'limit' => 60,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'どこの会社に属しているか',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('pay_department_code', 'string', [
                'comment' => 'EPSON給与応援ソフト連携用の店舗部門コード（EPSON給与ソフトの使用要確認）',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('fin_department_code', 'string', [
                'comment' => 'EPSON財務応援で設定している店舗の現金出納借方部門コード（EPSON給与ソフトの使用要確認）',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('start_date', 'datetime', [
                'comment' => '店舗の開始日（0~24の数値）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end_date', 'datetime', [
                'comment' => '店舗の終了日（0~24の数値）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('regular_start_time', 'integer', [
                'comment' => '通常時給時の開始時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('regular_end_time', 'integer', [
                'comment' => '通常時給時の終了時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('midnight_start_time', 'integer', [
                'comment' => '深夜時給時の開始時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('midnight_end_time', 'integer', [
                'comment' => '深夜時給時の終了時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('other1_start_time', 'integer', [
                'comment' => 'その他1時給時の開始時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('other1_end_time', 'integer', [
                'comment' => 'その他1時給時の終了時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('other2_start_time', 'integer', [
                'comment' => 'その他2時給時の開始時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('other2_end_time', 'integer', [
                'comment' => 'その他2時給時の終了時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('early_start_time', 'integer', [
                'comment' => '早番の開始時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('early_end_time', 'integer', [
                'comment' => '早番の終了時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('middle_start_time', 'integer', [
                'comment' => '中番の開始時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('middle_end_time', 'integer', [
                'comment' => '中番の終了時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('late_start_time', 'integer', [
                'comment' => '遅番の開始時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('late_end_time', 'integer', [
                'comment' => '遅番の終了時間（0~24の数値）',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データデータ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('time_cards')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => 'タイムカードごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('employee_id', 'integer', [
                'comment' => 'どの従業員のデータか',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('store_id', 'integer', [
                'comment' => '打刻時にどこの店舗に属しているか(店舗移動があるため必要)',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('date', 'date', [
                'comment' => 'YYYY/MM/DD',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('in_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('out_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('in_time2', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('out_time2', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('schedules_in_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('scheduled_out_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('work_time', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 2,
                'scale' => 1,
            ])
            ->addColumn('over_time', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 2,
                'scale' => 1,
            ])
            ->addColumn('paid_vacation', 'decimal', [
                'comment' => '(現状1.0=１日のみ)',
                'default' => null,
                'null' => true,
                'precision' => 2,
                'scale' => 1,
            ])
            ->addColumn('paid_vacation_start_time', 'integer', [
                'comment' => '有給計算用の開始時間(0~24の数値)',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('paid_vacation_end_time', 'integer', [
                'comment' => '有給計算用の終了時間(0~24の数値)',
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('note', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('attendance_store_id', 'integer', [
                'comment' => 'タイムカード打刻をした店舗(応援のため所属店舗以外の場合もある)',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('users')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'comment' => 'ユーザごとの一意のID（システム内部使用用）',
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('code', 'string', [
                'comment' => 'ユーザごとの一意のコード',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'どこの会社に属しているか',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('store_id', 'integer', [
                'comment' => 'どこの店舗に属しているか（会社・本社管理者の場合は店舗IDはない）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('name', 'string', [
                'comment' => 'ユーザ名',
                'default' => null,
                'limit' => 60,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'comment' => 'パスワード',
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('type', 'string', [
                'comment' => '（A:全社管理者、H:本社管理者、M:店舗管理者、G:一般）',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'データ作成日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'データ作成者（システム内部使用用）',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'データ最終更新日（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'datetime', [
                'comment' => 'データ最終更新者（システム内部使用用）',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('accounts');
        $this->dropTable('cash_account_trans');
        $this->dropTable('companies');
        $this->dropTable('employees');
        $this->dropTable('inventory_item_histories');
        $this->dropTable('inventory_items');
        $this->dropTable('inventory_purchase_transactions');
        $this->dropTable('menu_histories');
        $this->dropTable('menus');
        $this->dropTable('permit_pcs');
        $this->dropTable('sales_data_interfaces');
        $this->dropTable('sales_item_assign_histories');
        $this->dropTable('sales_item_histories');
        $this->dropTable('sales_item_transactions');
        $this->dropTable('sales_items');
        $this->dropTable('sales_transactions');
        $this->dropTable('store_account_infos');
        $this->dropTable('store_inventory_item_histories');
        $this->dropTable('store_menu_histories');
        $this->dropTable('stores');
        $this->dropTable('time_cards');
        $this->dropTable('users');
    }
}
