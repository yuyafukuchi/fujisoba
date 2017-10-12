<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesItemTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesItemTransactionsTable Test Case
 */
class SalesItemTransactionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesItemTransactionsTable
     */
    public $SalesItemTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sales_item_transactions',
        'app.sales_transactions',
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
        $config = TableRegistry::exists('SalesItemTransactions') ? [] : ['className' => 'App\Model\Table\SalesItemTransactionsTable'];
        $this->SalesItemTransactions = TableRegistry::get('SalesItemTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesItemTransactions);

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
