<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InventoryItemHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InventoryItemHistoriesTable Test Case
 */
class InventoryItemHistoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InventoryItemHistoriesTable
     */
    public $InventoryItemHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.inventory_item_histories',
        'app.inventory_items',
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
        'app.store_inventory_item_histories',
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
        $config = TableRegistry::exists('InventoryItemHistories') ? [] : ['className' => InventoryItemHistoriesTable::class];
        $this->InventoryItemHistories = TableRegistry::get('InventoryItemHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InventoryItemHistories);

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
