<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountsTable Test Case
 */
class AccountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountsTable
     */
    public $Accounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.accounts',
        'app.store_account_infos',
        'app.stores',
        'app.companies',
        'app.employees',
        'app.time_cards',
        'app.users',
        'app.cash_account_trans',
        'app.cash_accounts',
        'app.inventory_purchase_transactions',
        'app.inventory_items',
        'app.inventory_item_histories',
        'app.store_inventory_item_histories',
        'app.sales_transactions',
        'app.menus',
        'app.sales_item_transactions',
        'app.sales_items',
        'app.sales_item_assign_histories',
        'app.menu_items',
        'app.sales_item_histories',
        'app.store_menu_histories',
        'app.debit_categories',
        'app.credit_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Accounts') ? [] : ['className' => AccountsTable::class];
        $this->Accounts = TableRegistry::get('Accounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Accounts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
