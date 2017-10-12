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
        'app.inventory_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InventoryItemHistories') ? [] : ['className' => 'App\Model\Table\InventoryItemHistoriesTable'];
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
