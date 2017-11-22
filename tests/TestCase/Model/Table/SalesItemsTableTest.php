<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesItemsTable Test Case
 */
class SalesItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesItemsTable
     */
    public $SalesItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sales_items',
        'app.sales_item_assign_histories',
        'app.menu_items',
        'app.sales_item_histories',
        'app.sales_item_transactions',
        'app.sales_transactions',
        'app.stores',
        'app.companies',
        'app.employees',
        'app.time_cards',
        'app.users',
        'app.cash_account_trans',
        'app.accounts',
        'app.store_account_infos',
        'app.debit_categories',
        'app.credit_categories',
        'app.inventory_purchase_transactions',
        'app.inventory_items',
        'app.inventory_item_histories',
        'app.store_inventory_item_histories',
        'app.store_menu_histories',
        'app.menus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SalesItems') ? [] : ['className' => SalesItemsTable::class];
        $this->SalesItems = TableRegistry::get('SalesItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesItems);

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
