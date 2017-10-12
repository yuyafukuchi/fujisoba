<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesItemAssignHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesItemAssignHistoriesTable Test Case
 */
class SalesItemAssignHistoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesItemAssignHistoriesTable
     */
    public $SalesItemAssignHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sales_item_assign_histories',
        'app.menu_items',
        'app.sales_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SalesItemAssignHistories') ? [] : ['className' => 'App\Model\Table\SalesItemAssignHistoriesTable'];
        $this->SalesItemAssignHistories = TableRegistry::get('SalesItemAssignHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesItemAssignHistories);

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
