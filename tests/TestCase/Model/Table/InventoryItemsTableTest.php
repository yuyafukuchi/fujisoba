<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InventoryItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InventoryItemsTable Test Case
 */
class InventoryItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InventoryItemsTable
     */
    public $InventoryItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.inventory_items',
        'app.inventory_item_histories',
        'app.inventory_purchase_transactions',
        'app.store_inventory_item_histories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InventoryItems') ? [] : ['className' => 'App\Model\Table\InventoryItemsTable'];
        $this->InventoryItems = TableRegistry::get('InventoryItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InventoryItems);

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
