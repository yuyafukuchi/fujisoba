<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CashAccountTransTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CashAccountTransTable Test Case
 */
class CashAccountTransTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CashAccountTransTable
     */
    public $CashAccountTrans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cash_account_trans',
        'app.stores',
        'app.companies',
        'app.employees',
        'app.time_cards',
        'app.users',
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
        'app.store_account_infos',
        'app.accounts',
        'app.debit_categories',
        'app.credit_categories',
        'app.store_menu_histories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CashAccountTrans') ? [] : ['className' => CashAccountTransTable::class];
        $this->CashAccountTrans = TableRegistry::get('CashAccountTrans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CashAccountTrans);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
