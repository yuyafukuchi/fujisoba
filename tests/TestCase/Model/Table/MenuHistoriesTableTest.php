<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuHistoriesTable Test Case
 */
class MenuHistoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuHistoriesTable
     */
    public $MenuHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.menu_histories',
        'app.menu_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MenuHistories') ? [] : ['className' => 'App\Model\Table\MenuHistoriesTable'];
        $this->MenuHistories = TableRegistry::get('MenuHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenuHistories);

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
