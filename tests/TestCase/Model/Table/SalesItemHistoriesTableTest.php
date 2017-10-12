<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesItemHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesItemHistoriesTable Test Case
 */
class SalesItemHistoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesItemHistoriesTable
     */
    public $SalesItemHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sales_item_histories',
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
        $config = TableRegistry::exists('SalesItemHistories') ? [] : ['className' => 'App\Model\Table\SalesItemHistoriesTable'];
        $this->SalesItemHistories = TableRegistry::get('SalesItemHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesItemHistories);

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
