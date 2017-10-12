<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CashAccountTransTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CashAccountTransTable Test Case
 */
class CashAccountTransTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CashAccountTransTable
     */
    public $CashAccountTrans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cash_account_trans',
        'app.stores',
        'app.cash_accounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CashAccountTrans') ? [] : ['className' => 'App\Model\Table\CashAccountTransTable'];
        $this->CashAccountTrans = TableRegistry::get('CashAccountTrans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CashAccountTrans);

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
