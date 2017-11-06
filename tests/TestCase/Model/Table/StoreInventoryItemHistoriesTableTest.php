<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StoreInventoryItemHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StoreInventoryItemHistoriesTable Test Case
 */
class StoreInventoryItemHistoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StoreInventoryItemHistoriesTable
     */
    public $StoreInventoryItemHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.store_inventory_item_histories',
        'app.inventory_items',
        'app.inventory_item_histories',
        'app.inventory_purchase_transactions',
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
        'app.sales_transactions',
        'app.menus',
        'app.sales_item_transactions',
        'app.sales_items',
        'app.sales_item_assign_histories',
        'app.menu_items',
        'app.sales_item_histories',
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
        $config = TableRegistry::exists('StoreInventoryItemHistories') ? [] : ['className' => StoreInventoryItemHistoriesTable::class];
        $this->StoreInventoryItemHistories = TableRegistry::get('StoreInventoryItemHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StoreInventoryItemHistories);

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
