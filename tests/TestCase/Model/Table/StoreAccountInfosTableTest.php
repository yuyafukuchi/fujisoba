<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StoreAccountInfosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StoreAccountInfosTable Test Case
 */
class StoreAccountInfosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StoreAccountInfosTable
     */
    public $StoreAccountInfos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.store_account_infos',
        'app.accounts',
        'app.stores',
        'app.debit_categories',
        'app.credit_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StoreAccountInfos') ? [] : ['className' => 'App\Model\Table\StoreAccountInfosTable'];
        $this->StoreAccountInfos = TableRegistry::get('StoreAccountInfos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StoreAccountInfos);

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
