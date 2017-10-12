<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InventoryPurchaseTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InventoryPurchaseTransactionsTable Test Case
 */
class InventoryPurchaseTransactionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InventoryPurchaseTransactionsTable
     */
    public $InventoryPurchaseTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.inventory_purchase_transactions',
        'app.inventory_items',
        'app.inventory_item_histories',
        'app.store_inventory_item_histories',
        'app.stores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InventoryPurchaseTransactions') ? [] : ['className' => 'App\Model\Table\InventoryPurchaseTransactionsTable'];
        $this->InventoryPurchaseTransactions = TableRegistry::get('InventoryPurchaseTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InventoryPurchaseTransactions);

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
